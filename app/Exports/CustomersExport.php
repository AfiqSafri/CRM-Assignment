<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $fromDate;
    protected $toDate;

    public function __construct($fromDate = null, $toDate = null)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function collection()
    {
        $query = Customer::query();

        if ($this->fromDate && $this->toDate) {
            $query->whereBetween('created_at', [$this->fromDate, $this->toDate]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone Number',
            'Address',
            'ID Number',
            'Created At',
            'Updated At'
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->name,
            $customer->email,
            $customer->phone_number,
            $customer->address,
            $customer->id_number,
            $customer->created_at,
            $customer->updated_at,
        ];
    }
}
