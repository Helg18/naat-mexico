/********************************************************************************/
/******************** Documentacion de los endpoints del api ********************/
/********************************************************************************/

//Login

POST  =>     api/login      => recibe:  email
																				contraseña       

														=> Devuelve: Token de session

//Register
POST =>      api/register  => recibe:   nombre
																				apellido
																				fecha_nac
																				fecha_ingreso_uvm
																				celular
																				puesto
																				campus
																				num_empleado
																				metas_ni
																				metas_pno
																				email
																				password
													 => Devuelve: estatus del error
													 							mensaje

//Recuperacion de contraseña
POST  =>           api/postRecoverPassword          => recibe: email
																										=> devuelve: Estatus de error
																										             Mensaje

//Reglas del juego
POST =>        api/reglasdeljuego   => recibe: token
																	  => Devuelve: todas las reglas activas
																	 							decripcion_regla
																	 							error
																	 							mensaje de error


//Fechas
POST =>         api/fechas         => recibe: token
																	 => devuelve: Todas las fechas activas
																	              descripcion de las fechas
																	              error
																	              mensaje de error 


//Premios
POST   =>        api/premios       => recibe: token
                                   => devuelve: Todos los premios activos
                                                Descripcion de los premios
                                                error
                                                mensaje de error
                                                

//Categorias y subcategorias
POST  =>         api/categorias      => recibe: token
																		 => devuelve: todas las categorias
																		              todas las subcategorias
																		              error
																		              mensaje de error


//Iniciativas
POST =>          api/iniciativas       => recibe: token
																			 => devuelve: todas las iniciativas activas
																			              error
																			              mensaje de error

//guardar_iniciativas
POST  =>        api/guardar_iniciativas  => recibe: token
																										arreglo de iniciativas o titulos de las iniciativas
																										categoria_id
																										id_subcategoria
																										propuesta
																										orden_propuesta
																										evidencia_video
																										evidencia_foto
																										evidencia_texto
																					=> Devuleve: mensaje
																											 error
																											 

//decalogos
POST =>        api/decalogos            => recibe: token
																				=> devuelve: todos los decalogos activos
																										 error
																										 mensaje de error
																		              
//Listar tips
POST  =>          api/tips                 => recibe:   token
																				 => devuelve: tips
																											comentario
																											id_user
																											id_categoria
																											id_subcategoria
																											categorias
																											subcategorias

//Guardar Tips
POST  =>        api/guardar_tip            => recibe: titulo
																											comentario
																											id_categoria
																											id_subcategoria
																					 => devuelve: error
																					              mensaje
