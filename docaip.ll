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

																		              
