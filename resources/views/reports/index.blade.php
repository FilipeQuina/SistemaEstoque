@extends('layouts.app') @section('content')

<div class="container">
    <form action="/sales/reports" method="get">
            {{ csrf_field() }}
        <label for="dateBegin">Data inicio</label>
        <input type="date" name="dateBegin" id="dateBegin" required>
        <label for="dateEnd">Data Final</label>
        <input type="date" name="dateEnd" id="dateEnd" required>
        <button type="submit">Buscar</button>

    </form>

    <table class="table table-condensed table-bordered">
        <tr>
            <th>Código da venda</th>
            <th>Data</th>
            <th>Total</th>
            <th>Detalhes</th>
        </tr>
        @isset($reports)
        @foreach($reports as $report)
        <tr>
            <td>{{$report['id']}}</td>
            <td>{{date('d-m-Y H:i:s', strtotime($report['created_at']))}}</td>
            <td>{{$report['totalValueSale']}}</td>
        </tr>
        @endforeach
        @endif
    </table>
</div>
@endsection