<table>
  <thead>
    <tr>
      <th>Pemasukkan SPP Bulan {{ $month }} - {{ $year }}</th>
    </tr>
  </thead>
</table>

<table>
  <thead>
    <tr>
      <th style="border: 1px solid black; font-weight:bold">NIS</th>
      <th style="border: 1px solid black; font-weight:bold">Nama</th>
      <th style="border: 1px solid black; font-weight:bold">Kelas</th>
      <th style="border: 1px solid black; font-weight:bold">Jurusan</th>
      <th style="border: 1px solid black; font-weight:bold">Total</th>
      <th style="border: 1px solid black; font-weight:bold">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($invoices as $bill)
    <tr>
      <td style="border: 1px solid black;">{{ $bill->user->students->nis }}</td>
      <td style="border: 1px solid black;">{{ $bill->user->name }}</td>
      <td style="border: 1px solid black;">{{ $bill->bill->grade->name }}</td>
      <td style="border: 1px solid black;">{{ $bill->user->students->studyProgram->name }}</td>
      <td style="border: 1px solid black;">{{ $bill->total }}</td>
      <td style="border: 1px solid black;">{{ $bill->user->students->scholarship->name }}</td>
    </tr>
    @endforeach
    <tr>
      <th colspan="5" style="border: 1px solid black; font-weight:bold">Grand Total</th>
      @php
      $total = $invoices->sum('total');
      @endphp
      <th style="border: 1px solid black; font-weight:bold">{{ $total }}</th>
    </tr>
  </tbody>
</table>