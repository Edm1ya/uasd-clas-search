<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use App\Models\SubjectModality;
use App\Models\Weekdays;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('RNC')
                            ->label('RNC')
                            ->required(),
                        Forms\Components\TextInput::make('key')
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('section')
                            ->required(),
                        Forms\Components\Select::make('subject_modality_id')
                            ->relationship('modality', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('campus')
                            ->required(),
                        Forms\Components\Select::make('subject_type_id')
                            ->relationship('type', 'name')
                            ->required(),
                        Forms\Components\Select::make('schedule_id')
                            ->relationship('schedule', 'start_time')
                        ,
                        Forms\Components\TextInput::make('classroom')
                            ->required(),
                        Forms\Components\Select::make('day_subject')
                            ->multiple()
                            ->relationship('days', 'name')
                            ->options(Weekdays::all()->pluck('name', 'id'))
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('RNC')
                    ->label('RNC'),
                TextColumn::make('key'),
                TextColumn::make('name'),
                TextColumn::make('section'),
                TextColumn::make('modality.name'),
                TextColumn::make('campus'),
                TextColumn::make('type.name'),
                TextColumn::make('schedule.name'),
                TextColumn::make('classroom'),
                TextColumn::make('days.name'),






            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}
