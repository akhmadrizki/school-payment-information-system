<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccessRightsManagementTest extends TestCase
{
    public function testOnlyRoleMasterCanManageAdminData()
    {
        $role = User::find(1);
        $response = $this->actingAs($role)->get('/dashboard/admin');
        $response->assertSee('List Admin');
    }

    public function testOnlyRoleMasterCanDeleteStudentData()
    {
        $role = User::find(1);
        $response = $this->actingAs($role)->get('/dashboard/siswa');
        $response->assertSee('Hapus');
    }

    public function testTheSystemWillDisplayAdminDataMenuIfTheUserRoleIsMaster()
    {
        $role = User::find(1);
        $response = $this->actingAs($role)->get('/dashboard');
        $response->assertSee('Data Admin');
    }

    public function testOnlyRoleMasterAndAdminCanManageInvoiceBill()
    {
        $role = User::find(1);
        $response = $this->actingAs($role)->get('/dashboard/bill');
        $response->assertSee('List Tagihan');
    }

    public function testTheSystemWillNotDisplayInvoiceMenu()
    {
        $role = User::find(3);
        $response = $this->actingAs($role)->get('/dashboard');
        $response->assertDontSee('Buat Tagihan');
    }

    public function testOnlyRoleMasterAndAdminCanSeeArearsPage()
    {
        $role = User::find(1);
        $response = $this->actingAs($role)->get('/dashboard/tunggakan');
        $response->assertSee('List Tunggakan');
    }

    public function testOnlyRoleMasterAndAdminCanSeeIncomePage()
    {
        $role = User::find(1);
        $response = $this->actingAs($role)->get('/dashboard/pendapatan');
        $response->assertSee('Pemasukkan SPP');
    }

    public function testStudentCanSeePaymentInformationDataItself()
    {
        $role = User::find(3);
        $response = $this->actingAs($role)->get('/dashboard/info-pembayaran');
        $response->assertSee('Informasi Pembayaran SPP');
    }
}
