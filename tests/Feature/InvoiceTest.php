<?php

namespace Tests\Feature;

use App\Models\Bill;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    public function testCreateInvoiceThenSendNotification()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->post('/dashboard/bill', [
            'month' => 'may',
            'year' => '2022',
            'grade_id' => 3,
            'scholarship_id' => 1,
            'total' => 180000,
            'description' => 'Tagihan SPP bulan mei 2022',
        ]);

        $response->assertStatus(302);
    }

    public function testUpdateStatusPeyementIfStudentPaidSuccessfully()
    {
        $user = User::find(1);
        $bill = Invoice::find(1);

        $response = $this->actingAs($user)->put('/dashboard/bill/' . $bill->id, [
            'status' => 'PAID',
        ]);

        $response->assertStatus(500);
    }

    public function testExportIncomeToExcelFormat()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)->get('/dashboard/pendapatan?month=may&year=2022');
        $response->assertSee('Download Data');
    }

    public function testSendReminderNotificationToParentForStudentWhoHavePaid()
    {
        $user = User::find(1);
        $bill = Bill::find(1);
        $response = $this->actingAs($user)->get('/dashboard/tunggakan/' . $bill->id);
        $response->assertSee('Kirim pengingat');
    }
}
