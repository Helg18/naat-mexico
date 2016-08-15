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

//Reglas del juego
POST =>        api/reglasdeljuego   => recibe: token
																	  => Devuelve: todas las reglas activas
																	 							decripcion_regla
																	 							error
																	 							mensaje de error