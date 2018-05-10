const url = 'http://localhost/futbol/api/';

const entrar = url + 'entrar';
const acudientesHijos = url + 'acudiente/listar_todo';
const getAlumnoId = url + 'alumno/id';
const getCategoriaId = url + 'categoria/id';
const buscarAcudiente = url + 'acudiente/search';
const buscarCategoria = url + 'categoria/search';
const actualizarAlumno = url + 'alumno/set';
const cambiarEstadoAlumno = url+ 'alumno/estado';
const actualizarAdulto = url + 'acudiente/modificar'
const insertarAdulto = url + 'acudiente/insertar'
const nuevoAlumno = url + 'alumno/save'
const allCategorias = url +'categoria/all'
const actualizarCategoria = url + 'categoria/set'
const insertarCategoria = url + 'categoria/save'

export  {
  entrar,
  acudientesHijos,
  getAlumnoId,
  getCategoriaId,
  buscarAcudiente,
  buscarCategoria,
  actualizarAlumno,
  cambiarEstadoAlumno,
  actualizarAdulto,
  insertarAdulto,
  nuevoAlumno,
  allCategorias,
  actualizarCategoria,
  insertarCategoria
}
