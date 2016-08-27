/********************************************************************************/
/******************** Documentacion de los endpoints del api ********************/
/********************************************************************************/

//Login

POST  =>     api/login      => recibe:  email      => email 
																				password   => string

														=> Devuelve: Token de session

//Register
POST =>      api/register  => recibe:   nombre              => string
																				apellido            => string
																				foto                => image jpg|jpeg max:2mb
																				fecha_nac           => dd-mm-aaaad
																				fecha_ingreso_uvm   => dd-mm-aaaa
																				celular             => string
																				puesto              => string
																				campus              => string
																				num_empleado        => integer
																				metas_ni            => integer
																				metas_pno           => integer
																				email               => email
																				password            => password
													 => Devuelve: estatus del error   => true o false
													 							mensaje             => mensaje de estatus

//Recuperacion de contraseña
POST  =>           api/postRecoverPassword          => recibe: email                => email
																										=> devuelve: Estatus de error   => true o false
																										             Mensaje            => mensaje de estatus

//Reglas del juego
POST =>        api/reglasdeljuego   => recibe: token
																	  => Devuelve:  todas las reglas activas => array con reglas del juego y decricion_regla
																									decripcion_regla         
																									error                    => true o false 
																									mensaje de error         => mensaje de error


//Fechas
POST =>         api/fechas         => recibe: token
																	 => devuelve: Todas las fechas activas   => array con las fechas y descripcion de las fechas en formato aaaa-mm-dd
																	              descripcion de las fechas  => string
																	              error                      => true o false
																	              mensaje de error           => mensaje de error


//Premios
POST   =>        api/premios       => recibe: token
                                   => devuelve: Todos los premios activos      => array con los premios y descripciones String
                                                Descripcion de los premios     => viene en el array String
                                                error                          => true o false
                                                mensaje de error               => mensaje de error
                                                

//Categorias y subcategorias
POST  =>         api/categorias      => recibe: token
																		 => devuelve: todas las Categorias       => array con integer-> id | string->categoria/subcategoria
																		              todas las subcategorias    => array con integer-> id | string->categoria/subcategoria
																		              error                      => true o false
																		              mensaje de error           => mensaje de error


//Iniciativas
POST =>          api/iniciativas       => recibe: token
																			 => devuelve: todas las iniciativas activas    => array con integer->id | string->titulos
																			              titulo                => string esta en el array
																			              error                 => true o false
																			              mensaje de error      => mensaje de error
																			              valoraciones => array[calificaion->float, id_iniciativas->integer]


//guardar_iniciativas
POST  =>        api/guardar_iniciativas  => recibe: token
																										arreglo de titulos de las iniciativas
																										categoria_id       => integer
																										id_subcategoria    => integer
																										propuesta          => string
																										orden_propuesta    => integer
																										evidencia_video    => string
																										evidencia_foto     => string
																										evidencia_texto    => text
																			 => Devuleve: error              => true o false
																			              mensaje de error   => mensaje de error
																											 

//decalogos
POST =>        api/decalogos            => recibe: token
																				=> devuelve: todos los decalogos activos => array con id->integer | decalogo
																										 error                 => true o false
																										 mensaje de error      => mensaje de error
																		              
//Listar mis tips
POST  =>          api/tips               => recibe:   token
																				 => devuelve: tips                  => array principal array[id->integer, tip->string]
																											comentario            => string
																											categorias            => Esta dentro del array principal tinee id->integer | y titulo->string
																											subcategorias         => Esta dentro del array principal tinee id->integer | y titulo->string
																											error                 => true o false
																											mensaje de error      => mensaje de error
																											votaciones_tips       => array[tip_id->integer, calificacion->float]

//Guardar Tips
POST  =>        api/guardar_tip            => recibe: titulo            => string
																											comentario        => text
																											id_categoria      => integer
																											id_subcategoria   => ingeter
																					 => devuelve: error                 => true o false
																											  mensaje de error      => mensaje de error


//guardar votaviones
POST   =>       api/guardar_votaciones     =>  recibe:  token
																												id_iniciativa => integer
																												calificacion  => integer
																												comentario    => text | Puede ser nulo
																					 => devuelve: error         => true o false
																					 							mensaje       => mensaje de estatus

//Listar votaciones
POST    =>  api/listar_votaciones         => recibe:  token
																					=> devuelve: error                 => true o false
																											 mensaje de error      => mensaje de error
																											 votaciones => array[id->integer, calificacion->integer]
																											 iniciativa => array[id->integer, titulos->string]
																											 users => array[id->integer, name->string]

//TOPTEN
POST     =>   api/top_ten               =>  recibe:  token
																										
																				=> devuelve: error              => true o false
																										 mensaje de error   => mensaje de error
																										 'top ten'    => $array ,
																										 'iniciativa' => $iniciativa,
																										 'users'      => $user


//listar_tips ---> TODOS LOS TIPS 
POST   =>  api/listar_tips      => recibe:    token
                                => devuelve:  tips              => array principal array[id->integer, tip->string]
																							comentario        => string
																							categorias        => Esta dentro del array principal tinee id->integer | y titulo->string
																							subcategorias     => Esta dentro del array principal tinee id->integer | y titulo->string
																							error             => true o false
																							mensaje de error  => mensaje de error
																							calificacion_tips => array[tip_id->integer, calificacion->float]



//mis iniciativas
POST   =>  api/miiniciativas    =>   recibe: token
                                => devuelve: iniciativasdetalles => array con los siguientes campos
													                                						 id_iniciativas   => integer 
													                                             id_categoria     => integer 
													                                             id_subcategoria  => integer
													                                        		 propuesta        => text
													                                        		 orden_propuesta  => integer
													                                        		 evidencia_video  => text
													                                        		 evidencia_foto   => text
													                                        		 evidencia_te     => text
													                   iniciativas    =>  array [id->integer    titulo->string]
													                   valoraciones => array[calificaion->float, id_iniciativas->integer]

//guardar preguntas
POST    => api/guardar_pregunta        => Recibe: token 
																									pregunta->text
																			 =>devuelve: error estatus true o false
																			 						 mensaje de estatus -> string


//Guardar respuesta
POST  =>     api/guardar_pregunta      => recibe: token
																									respuesta->text
																									preguntas_id->ingeter
																			 =>devuelve: error estatus true o false
																			 						 mensaje de estatus -> string

//listar preguntas y respuestas de un usuario logueado
POST   =>    api/preguntas_respuestas       =>  recibe: token
																						=>devuelve: preguntas->array[id->integer, pregunta->text]
																												respuestas->array[id->integer, respuesta->text, preguntas_id->integer]
