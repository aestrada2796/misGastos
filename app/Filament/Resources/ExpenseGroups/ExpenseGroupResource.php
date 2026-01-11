<?php

namespace App\Filament\Resources\ExpenseGroups;

use App\Filament\Resources\ExpenseGroups\Pages\CreateExpenseGroup;
use App\Filament\Resources\ExpenseGroups\Pages\EditExpenseGroup;
use App\Filament\Resources\ExpenseGroups\Pages\ListExpenseGroups;
use App\Filament\Resources\ExpenseGroups\Schemas\ExpenseGroupForm;
use App\Filament\Resources\ExpenseGroups\Tables\ExpenseGroupsTable;
use App\Models\ExpenseGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseGroupResource extends Resource
{
    protected static ?string $model = ExpenseGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ExpenseGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpenseGroupsTable::configure($table);
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
            'index' => ListExpenseGroups::route('/'),
            'create' => CreateExpenseGroup::route('/create'),
            'edit' => EditExpenseGroup::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
