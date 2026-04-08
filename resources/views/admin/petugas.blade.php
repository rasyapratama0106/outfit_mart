@extends('layouts.admin')

@section('title', 'Data Petugas')

@section('content')

<style>

/* TABLE */

.table-container{
padding:20px;
}

table{
width:100%;
border-collapse:collapse;
background:#1E3A8A;
color:white;
border-radius:10px;
overflow:hidden;
}

th, td{
padding:12px;
text-align:center;
}

th{
background:#111;
}

tr{
border-bottom:1px solid rgba(255,255,255,0.2);
}

tr:hover{
background:#274472;
}

.status{
font-weight:bold;
color:#00ff88;
}

.hapus{
color:red;
cursor:pointer;
font-size:18px;
text-decoration:none;
}

</style>

<div class="table-container">

<table>
<tr>
<th>ID</th>
<th>Nama</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>
<th>Aksi</th>
</tr>

@foreach($petugas as $p)

<tr>
<td>OTM{{ $p->id }}</td>
<td>{{ $p->nama }}</td>
<td>{{ $p->email }}</td>
<td>PETUGAS</td>
<td class="status">AKTIF</td>

<td>
    <a href="{{ url('/admin/petugas/delete/'.$p->id) }}"
       onclick="return confirm('Yakin hapus?')"
       class="hapus">
       🗑
    </a>
</td>

</tr>

@endforeach

</table>

</div>

@endsection