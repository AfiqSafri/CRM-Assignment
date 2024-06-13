<?
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;

class ReportsExport implements FromCollection
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        // Fetch and return the report data as a collection
        return collect([
            ['Total Customers', Customer::count()],
            ['Total Sales', Sale::sum('amount')],
            ['Total Revenue', Revenue::sum('amount')],
            ['New Customers', Customer::where('created_at', '>=', now()->subMonth())->count()],
            // Add more report data as needed
        ]);
    }
}
