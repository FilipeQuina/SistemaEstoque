@extends('layouts.app') @section('content')

<div class="container">
    <form action="/sales/reports" method="get" class="noprint">
        {{ csrf_field() }}
        <div class="row espacamento">
            <div class="col-md-2">
                <label for="dateBegin">Data inicio</label>
                <input type="date" name="dateBegin" id="dateBegin" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label for="dateEnd">Data Final</label>
                <input type="date" name="dateEnd" id="dateEnd" class="form-control" required>
            </div>

        </div>
        <div class="row espacamentoEsquerda">
            <div>
                <label for="orcamento">Orçamento?:</label>
                <input type="checkbox" name="orcamento" id="orcamento">
            </div>

        </div>
        <div class="row espacamento espacamentoEsquerda">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>

    </form>



    <table class="table table-condensed table-bordered">
        <tr>
            <th>Código da venda</th>
            <th>Data</th>
            <th>Total</th>

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

</div>
@endsection