<?php
namespace App\Enum;

enum Status: string
{
    case draft = 'draft';
    case pending_payement = 'pending';
    case paid = 'paid';
}