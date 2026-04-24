<h1>{{modeDsc}}</h1>

<form method="POST">

<input type="hidden" name="id" value="{{id}}">

<label>Titulo</label>
<input type="text" name="titulo" value="{{titulo}}">

<label>Descripcion</label>
<input type="text" name="descripcion" value="{{descripcion}}">

<label>Fecha</label>
<input type="date" name="fecha" value="{{fecha}}">

<label>Activa</label>
<input type="checkbox" name="activa" value="1" {{if activa}}checked{{endif activa}}>

<br><br>

<button type="submit">Guardar</button>

<a href="index.php?page=Mantenimientos-Encuestas-Listado">
Cancelar
</a>

</form>

