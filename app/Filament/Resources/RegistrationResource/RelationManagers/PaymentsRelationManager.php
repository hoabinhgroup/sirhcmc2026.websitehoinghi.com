<?php

namespace App\Filament\Resources\RegistrationResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'Thanh toán';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('provider')->label('Provider'),
                Tables\Columns\TextColumn::make('payment_method')->label('Method'),
                Tables\Columns\TextColumn::make('amount')->label('Amount')->numeric(decimalPlaces: 0),
                Tables\Columns\TextColumn::make('transaction_fee')->label('Fee')->numeric(decimalPlaces: 0),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('gateway_transaction_id')->label('Txn ID')->limit(20),
                Tables\Columns\TextColumn::make('paid_at')->label('Paid at')->dateTime(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
