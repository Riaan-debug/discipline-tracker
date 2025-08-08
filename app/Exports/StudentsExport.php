<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle, ShouldAutoSize
{
    protected $students;
    protected $title;

    public function __construct($students, $title = 'Students Report')
    {
        $this->students = $students;
        $this->title = $title;
    }

    public function collection()
    {
        return $this->students;
    }

    public function headings(): array
    {
        return [
            'ID',
            'First Name',
            'Last Name',
            'Email',
            'Grade',
            'Parent Name',
            'Parent Email',
            'Parent Phone',
            'Status',
            'Total Incidents',
            'Active Incidents',
            'Resolved Incidents',
            'Escalated Incidents',
            'Last Incident Date',
            'Member Since',
            'Notes'
        ];
    }

    public function map($student): array
    {
        $lastIncident = $student->incidents()->latest()->first();
        
        return [
            $student->id,
            $student->first_name,
            $student->last_name,
            $student->email,
            $student->grade,
            $student->parent_name,
            $student->parent_email,
            $student->parent_phone,
            $student->is_active ? 'Active' : 'Inactive',
            $student->incidents()->count(),
            $student->incidents()->where('status', 'open')->count(),
            $student->incidents()->where('status', 'resolved')->count(),
            $student->incidents()->where('status', 'escalated')->count(),
            $lastIncident ? $lastIncident->created_at->format('Y-m-d') : 'N/A',
            $student->created_at->format('Y-m-d'),
            $student->notes
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header styling
        $sheet->getStyle('A1:P1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3B82F6'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Add borders to all cells
        $sheet->getStyle('A1:P' . ($this->students->count() + 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'E5E7EB'],
                ],
            ],
        ]);

        // Alternate row colors
        for ($row = 2; $row <= $this->students->count() + 1; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':P' . $row)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F9FAFB'],
                    ],
                ]);
            }
        }

        // Status column styling
        $sheet->getStyle('I2:I' . ($this->students->count() + 1))->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        // Incident count columns styling
        $sheet->getStyle('J2:L' . ($this->students->count() + 1))->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        return $sheet;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // ID
            'B' => 15,  // First Name
            'C' => 15,  // Last Name
            'D' => 25,  // Email
            'E' => 10,  // Grade
            'F' => 20,  // Parent Name
            'G' => 25,  // Parent Email
            'H' => 15,  // Parent Phone
            'I' => 12,  // Status
            'J' => 15,  // Total Incidents
            'K' => 15,  // Active Incidents
            'L' => 15,  // Resolved Incidents
            'M' => 15,  // Escalated Incidents
            'N' => 15,  // Last Incident Date
            'O' => 15,  // Member Since
            'P' => 30,  // Notes
        ];
    }

    public function title(): string
    {
        return $this->title;
    }
} 