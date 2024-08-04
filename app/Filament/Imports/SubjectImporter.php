<?php

namespace App\Filament\Imports;

use App\Models\Schedule;
use App\Models\Subject;
use App\Models\SubjectModality;
use App\Models\SubjectType;
use App\Models\Weekdays;
use Carbon\Carbon;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubjectImporter extends Importer
{
    protected static ?string $model = Subject::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('NRC')
                ->label('NRC')
                ->requiredMapping()
                ->rules(['required', 'max:6']),
            ImportColumn::make('key')
                ->guess(['Clave'])
                ->requiredMapping()
                ->rules(['required', 'max:8']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->guess(['Asignatura'])
                ->rules(['required', 'max:100']),
            ImportColumn::make('section')
                ->guess(['Sección'])
                ->requiredMapping()
                ->rules(['required', 'max:5']),
            ImportColumn::make('subject_modality_id')
                ->castStateUsing(function (string $originalState) {
                    $modality = SubjectModality::where('name', $originalState)?->first();
                    return $modality ? $modality->id : null;
                })
                ->label('modality')
                ->guess(['Modalidad'])
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('campus')
                ->requiredMapping()
                ->rules(['required', 'max:100']),
            ImportColumn::make('subject_type_id')
                ->label('type')
                ->guess(['Tipo'])
                ->castStateUsing(function (string $originalState) {
                    $type = SubjectType::where('name', Str::of($originalState)->lower()->toString())?->first();
                    return $type ? $type->id : null;
                })
                ->rules(['integer']),
            ImportColumn::make('schedule')
                ->guess(['Horario'])
                ->castStateUsing(function (string $originalState) {
                    $data = explode(' ', $originalState);
                    if (count($data) != 3) {
                        return null;
                    }

                    $time = Schedule::firstOrCreate([
                        'start_time' => Carbon::createFromTime($data[0]),
                        'end_time' => Carbon::createFromTime($data[2])
                    ]);

                    return $time->id;
                })
                ->relationship(),
            ImportColumn::make('classroom')
                ->guess(['Aula'])
                ->rules(['max:15']),
            // ImportColumn::make('days')
            //     ->guess(['Días'])
            // ->castStateUsing(function (string $originalState) {
            //     $chunks = str_split($originalState, 2);

            //     if (count($chunks) == 0) {
            //         return null;
            //     }

            //     foreach ($chunks as $key => $value) {
            //         # code...
            //         dd($value);
            //     }
            // })

        ];
    }

    protected function afterCreate(): void
    {
        $chunks = str_split($this->data['Días'], 2);

        if (count($chunks) != 0) {
            foreach ($chunks as $key => $value) {
                $day = Weekdays::where('abbreviation', $value)->pluck('id')->first();

                DB::table('day_subject')->insert([
                    'subject_id' => $this->record->id,
                    'weekdays_id' => $day
                ]);
            }
        }



        // Similar to `afterSave()`, but only runs when creating a new record.
    }

    public function resolveRecord(): ?Subject
    {
        // dd($this->data);
        // return Subject::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Subject();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your subject import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
