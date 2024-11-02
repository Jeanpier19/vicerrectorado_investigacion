<table>
  <tr>
    <th colspan="6">Vicerrectorado de Investigación - VRI UNASAM</th>
  </tr>
  <tr>
    <th colspan="6">Convenios</th>
  </tr>
  <tr>
    <th colspan="6"></th>
  </tr>
  <tr>
    <th colspan="3">Tipo de Convenio:</th>
    <th colspan="3">Marco</th>
  </tr>
  <tr>
    <th colspan="3">Tipo de Convenio Específico:</th>
    <th colspan="3">---</th>
  </tr>
  <tr>
    <th colspan="3">Facultad:</th>
    <th colspan="3">---</th>
  </tr>
  <tr>
    <th colspan="6">Reporte de {{ $qty_toshow }} registros</th>
  </tr>
  <tr>
    <th>#</th>
    <th>RESOLUCIÓN</th>
    <th>INSTITUCIÓN</th>
    <th>OBJETIVO</th>
    <th>VIGENCIA</th>
    <th>ESTADO</th>
  </tr>
  @foreach($convenios as $key => $convenio)
  <tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $convenio->resolucion }}</td>
    <td>{{ $convenio->facultad_id }}</td>
    <td>{{ $convenio->objetivo }}</td>
    <td>{{ $convenio->vigencia }}</td>
    <td>{{ $convenio->estado }}</td>
  </tr>
  @endforeach
</table>