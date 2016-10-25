
<h1>Documentacion de la API</h1>
<style>
h2{
	text-transform: uppercase;
}
div{
	margin: 30px 20px;
	border-bottom: solid 2px #000;
}
</style>
<div>
	<h2>Login</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/login</p>
	
	<p><b>@params</b></p>
	<p>email (obligatorio)</p>
	<p>password (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjExLCJpc3MiOiJodHRwczpcL1wvc2VjdXJlLmtyZWF0aXZlY28uY29tXC9uYWF0XC9wdWJsaWNcL2FwaVwvbG9naW4iLCJpYXQiOjE0NzMzNTkyNjcsImV4cCI6MTQ3MzQ0NTY2NywibmJmIjoxNDczMzU5MjY3LCJqdGkiOiI1OTQxYzkwMWZhZmUzZDRlNjRkZmU3MmJhYWI3MTk5NSJ9.m3n9AJIeEGxc_HBsEFc2tdFr8a3Gec5EKwSLHh0LLsA"
	}	
	</pre>
</div>



<div>
	<h2>Registro</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/register</p>
	
	<p><b>@params</b></p>
	<p>nombre (obligatorio)</p>
	<p>email (obligatorio)</p>
	<p>apellido (obligatorio)</p>
	<p>fecha_nac (obligatorio)</p>
	<p>fecha_ingreso_uvm (obligatorio)</p>
	<p>celular (obligatorio)</p>
	<p>puesto (obligatorio)</p>
	<p>campus (obligatorio)</p>
	<p>password (obligatorio)</p>
	<p>num_empleado (obligatorio)</p>
	
	<p>foto </p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"message": "Usuario creado exitosamente",
		"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjExLCJpc3MiOiJodHRwczpcL1wvc2VjdXJlLmtyZWF0aXZlY28uY29tXC9uYWF0XC9wdWJsaWNcL2FwaVwvbG9naW4iLCJpYXQiOjE0NzMzNTkyNjcsImV4cCI6MTQ3MzQ0NTY2NywibmJmIjoxNDczMzU5MjY3LCJqdGkiOiI1OTQxYzkwMWZhZmUzZDRlNjRkZmU3MmJhYWI3MTk5NSJ9.m3n9AJIeEGxc_HBsEFc2tdFr8a3Gec5EKwSLHh0LLsA"
	}	
	</pre>
</div>



<div>
	<h2>Recuperar password</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/postRecoverPassword</p>
	
	<p><b>@params</b></p>
	<p>email (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"message": "El link de recuperación de contraseña se ha enviado.",
	}	
	</pre>
</div>






<div>
	<h2>OBTENER PERFIL</h2>
	
	<p><b>@method GET</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/getProfile</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
	"error": false,
	"profile": {
		"id": 11,
		"name": "Fernando",
		"email": "fersaavedra85@hotmail.com",
		"nombre": "",
		"apellido": "",
		"fecha_nac": "",
		"fecha_ingreso_uvm": "",
		"celular": "",
		"puesto": "",
		"campus": "",
		"num_empleado": "",
		"metas_ni": "",
		"metas_pno": "",
		"is_active": 1,
		"created_at": "2016-09-01 16:27:35",
		"updated_at": "2016-09-01 16:27:35",
		"foto": "",
		"metas_registros": "",
		"metas_rev": "asdadasd"
	}
}
	</pre>
</div>


<div>
	<h2>ACTULIZAR PERFIL</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/postProfile</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>nombre (obligatorio)</p>
	<p>apellido (obligatorio)</p>
	<p>fecha_ingreso_uvm (obligatorio)</p>
	<p>celular (obligatorio)</p>
	<p>puesto (obligatorio)</p>
	<p>num_empleado (obligatorio)</p>
	
	<p><b>@return</b></p>
	<pre>
	{
	"error": false,
	"profile": {
		"id": 11,
		"name": "Fernando",
		"email": "fersaavedra85@hotmail.com",
		"nombre": "",
		"apellido": "",
		"fecha_nac": "",
		"fecha_ingreso_uvm": "",
		"celular": "",
		"puesto": "",
		"campus": "",
		"num_empleado": "",
		"metas_ni": "",
		"metas_pno": "",
		"is_active": 1,
		"created_at": "2016-09-01 16:27:35",
		"updated_at": "2016-09-01 16:27:35",
		"foto": "",
		"metas_registros": "",
		"metas_rev": "asdadasd"
	}
}
	</pre>
</div>


<div>
	<h2>ACTULIZAR META INVIVIDUAL</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/postUpdateMetas</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>meta (obligatorio)(opciones => [`metas_ni`, `metas_pno`, `metas_registros`, `metas_rev`])</p>
	<p>value (obligatorio)</p>
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"mensaje"=>"La de la meta  ha sido actulizada"
	}
	</pre>
</div>









<div>
	<h2>Reglas del juego</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/reglasdeljuego</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"reglas": [{
			"regla": "1-Test de primera Regla",
			"descripcion_regla": "Descripcion de primera Regla"
		}]
	}
	</pre>
</div>


<div>
	<h2>FECHAS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/fechas</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"fechas": []
	}
	</pre>
</div>




<div>
	<h2>PREMIOS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/premios</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"premios": []
	}
	</pre>
</div>










<div>
	<h2>CATEGORIAS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/categorias</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"categorias": [{
			"id": 1,
			"categoria": "DESTREZA"
		}, 
		{...}
		],
		"subcategorias": [{
			"id": 6,
			"categoria_id": 1,
			"subcategoria": "T\u00e9cnicas de venta"
		}, 
		{...}
		]
	}
	</pre>
</div>





<div>
	<h2>INICIATIVAS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/iniciativas</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
	"error": false,
	"iniciativas": {
		"destreza": {
			"tecnicas_de_venta": [{
				"id": 56,
				"titulo": "CONFIANZA",
				"descripcion": "CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd como:\r\n\r\n- INSCRIPCIONES PARA TODAS LAS LINEAS \r\n- RECOMENDACIONES (YA QUE SE VUELVE TU PROMOTOR)\r\n- Y TE ASEGURA EL REINGRESO",
				"id_categoria": 1,
				"id_subcategoria": 6,
				"id_user": 48,
				"propuesta": "CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd",
				"orden_propuesta": 0,
				"evidencia_video": "",
				"evidencia_foto": "",
				"evidencia_texto": "",
				"is_active": "1",
				"votaciones": {
					"calificacion": null,
					"iniciativa_id": null
				},
				"propuestas": ["CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd como:\r\n\r\n- INSCRIPCIONES PARA TODAS LAS LINEAS \r\n- RECOMENDACIONES (YA QUE SE VUELVE TU PROMOTOR)\r\n- Y TE ASEGURA EL REINGRESO"],
				"indicadores": [1, 2, 7],
				"users": {
					"name": "Isabel",
					"campus": "Reynosa",
					"foto": ""
				}
			},
			{...}
		],
			"oferta_academica": [{...}],
			"generacion_de_base_de_datos": [{...}],
			"gestion_de_base_de_datos": [{...}],
			"manejo_del_tiempo": [{...}],
		},
				  
	"uso_de_herramientas": {
						"salesforce" : [{...}],
						"comunidad_comercial_uvm" : [{...}],
						"microstrategy" : [{...}],
						"blackboard" : [{...}],
						"herramientas_de_venta" : [{...}],
	},
	
	"desarrollo_de_talento" {
								 "colaboracion" : [{...}],
								"clima_laboral" : [{...}],
								"crecimiento" : [{...}],
								"productividad" : [{...}],
		}
		
	}
	
}
	</pre>
</div>









<div>
	<h2>GUARDAR INICIATIVAS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/guardar_iniciativas</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	<p>titulo (obligatorio)</p>
	<p>descripcion (obligatorio)</p>
	<p>categoria_id (obligatorio)</p>
	<p>id_subcategoria (obligatorio)</p>
	
	<p>evidencia_video</p>
	<p>evidencia_foto</p>
	<p>evidencia_texto</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"mensaje": "Iniciativas guardadas con exito"		
	}
	</pre>
</div>




<div>
	<h2>DECALOGOS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/decalogos</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"decalogos": []
	}
	</pre>
</div>





<div>
	<h2>LISTA DE TIPS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/tips</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"data": [{
			"id": 15,
			"tip": "Role Play",
			"comentario": "Revisa la oferta educativa de tu campus, as\u00ed como los lanzamientos de nuevos productos, habla con el coordinador acad\u00e9mico de los programas que no domines y p\u00eddele programar con \u00e9l o con alg\u00fan profesor en un momento de baja contactaci\u00f3n o poca afluencia de prospectos un cita en el que pueda hacer el ejercicio del Role Play contigo.\n\u00c9l ser\u00e1 el prospecto y t\u00fa deber\u00e1s atenderlo para intentar inscribirlo. Al terminar \u00e9l te retroalimentar\u00e1 y te dir\u00e1 cu\u00e1les son tus \u00e1reas de oportunidad con respecto a las etapas de la venta, as\u00ed como los diferenciales y aspectos importantes para vender ese programa.\nEso ayudar\u00e1 a que seas m\u00e1s aut\u00f3nomo en la venta y puedas cerrar con mayor contundencia.\nEl formato de Role Play puedes solicitarlo a: gotomarket@uvmnet.edu",
			"id_user": 16,
			"categoria": {
				"id": 1,
				"categoria": "DESTREZA",
				"is_active": "1",
				"created_at": "2016-08-31 23:17:22",
				"updated_at": "2016-08-31 23:17:22"
			},
			"subcategoria": {
				"id": 9,
				"subcategoria": "Oferta Acad\u00e9mica",
				"categoria_id": 1,
				"is_active": "1",
				"created_at": "2016-09-02 02:27:55",
				"updated_at": "2016-09-02 02:27:55"
			},
			"votos": {
				"calificacion": "5.0"
			},
			"users": {
				"name": "Mari",
				"campus": "Corporativo",
				"foto": "logo-naat-example.png"
			}
		},
		
		{...}
		]
	}
	</pre>
</div>




<div>
	<h2>GUARDAR TIPS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/guardar_tips</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>titulo (obligatorio)</p>
	<p>comentario (obligatorio)</p>
	<p>id_categoria (obligatorio)</p>
	<p>id_subcategoria (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"mensaje": "Tip guardado exitosamente"
	}
	</pre>
</div>




<div>
	<h2>GUARDAR VOTACIONES</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/guardar_tips</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>id_iniciativa (obligatorio)</p>
	<p>calificacion (obligatorio)</p>
	<p>comentario (obligatorio)</p>
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"mensaje": "La calificafion de la iniciativa fue recibida exitosamente"
	}
	</pre>
</div>


<div>
	<h2>GUARDAR VOTACIONES</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/listar_votaciones</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	

	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"votaciones": [{
			"id": 1,
			"calificacion": 5,
			"id_iniciativa": 41,
			"id_user": 1
		},
		{...}
	}
	</pre>
</div>








<div>
	<h2>TOP TEN</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/top_ten</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"topten": {
			"destreza": {
				"tecnicas_de_venta": [{
					"id": 56,
					"titulo": "CONFIANZA",
					"descripcion": "CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd como:\r\n\r\n- INSCRIPCIONES PARA TODAS LAS LINEAS \r\n- RECOMENDACIONES (YA QUE SE VUELVE TU PROMOTOR)\r\n- Y TE ASEGURA EL REINGRESO",
					"id_categoria": 1,
					"id_subcategoria": 6,
					"id_user": 48,
					"propuesta": "CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd",
					"orden_propuesta": 0,
					"evidencia_video": "",
					"evidencia_foto": "",
					"evidencia_texto": "",
					"is_active": "1",
					"votaciones": {
						"calificacion": null,
						"iniciativa_id": null
					},
					"propuestas": ["CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd como:\r\n\r\n- INSCRIPCIONES PARA TODAS LAS LINEAS \r\n- RECOMENDACIONES (YA QUE SE VUELVE TU PROMOTOR)\r\n- Y TE ASEGURA EL REINGRESO"],
					"indicadores": [1, 2, 7],
					"users": {
						"name": "Isabel",
						"campus": "Reynosa",
						"foto": ""
					}
				},
				{...}
			],
				"oferta_academica": [{...}],
				"generacion_de_base_de_datos": [{...}],
				"gestion_de_base_de_datos": [{...}],
				"manejo_del_tiempo": [{...}],
			},
					  
		"uso_de_herramientas": {
							"salesforce" : [{...}],
							"comunidad_comercial_uvm" : [{...}],
							"microstrategy" : [{...}],
							"blackboard" : [{...}],
							"herramientas_de_venta" : [{...}],
		},
		
		"desarrollo_de_talento" {
									 "colaboracion" : [{...}],
									"clima_laboral" : [{...}],
									"crecimiento" : [{...}],
									"productividad" : [{...}],
			}
			
		}
		
	}
	</pre>
</div>



<div>
	<h2>Listar tips</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/listar_tips</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"tips": [{
			"id": 15,
			"tip": "Role Play",
			"comentario": "Revisa la oferta educativa de tu campus, as\u00ed como los lanzamientos de nuevos productos, habla con el coordinador acad\u00e9mico de los programas que no domines y p\u00eddele programar con \u00e9l o con alg\u00fan profesor en un momento de baja contactaci\u00f3n o poca afluencia de prospectos un cita en el que pueda hacer el ejercicio del Role Play contigo.\n\u00c9l ser\u00e1 el prospecto y t\u00fa deber\u00e1s atenderlo para intentar inscribirlo. Al terminar \u00e9l te retroalimentar\u00e1 y te dir\u00e1 cu\u00e1les son tus \u00e1reas de oportunidad con respecto a las etapas de la venta, as\u00ed como los diferenciales y aspectos importantes para vender ese programa.\nEso ayudar\u00e1 a que seas m\u00e1s aut\u00f3nomo en la venta y puedas cerrar con mayor contundencia.\nEl formato de Role Play puedes solicitarlo a: gotomarket@uvmnet.edu",
			"id_user": 16,
			"id_categoria": 1,
			"id_subcategoria": 9,
			"users": {
				"id": 16,
				"name": "Mari",
				"email": "CAPACITACIONCOMERCIAL@UVMNET.COM",
				"nombre": "Capacitaci\u00f3n",
				"apellido": "Comercial",
				"fecha_nac": "21-1-2000",
				"fecha_ingreso_uvm": "21-1-16",
				"celular": "0452525252",
				"puesto": "Asesor Educativo",
				"campus": "Corporativo",
				"num_empleado": "202030",
				"metas_ni": "90",
				"metas_pno": "110",
				"is_active": 1,
				"created_at": null,
				"updated_at": null,
				"foto": "logo-naat-example.png",
				"metas_registros": "",
				"metas_rev": ""
			}
		},
		{...}
		],
		"categorias": [{
			"id": 1,
			"categoria": "DESTREZA"
		}, {
			"id": 2,
			"categoria": "USO DE HERRAMIENTAS"
		}, {
			"id": 3,
			"categoria": "DESARROLLO DE TALENTO"
		}],
		"subcategorias": [{
			"id": 6,
			"categoria_id": 1,
			"subcategoria": "T\u00e9cnicas de venta"
		}, {
			"id": 7,
			"categoria_id": 2,
			"subcategoria": "Salesforce"
		}, {
			"id": 8,
			"categoria_id": 3,
			"subcategoria": "Colaboraci\u00f3n"
		}, {
			"id": 9,
			"categoria_id": 1,
			"subcategoria": "Oferta Acad\u00e9mica"
		}, {
			"id": 10,
			"categoria_id": 1,
			"subcategoria": "Generaci\u00f3n de Base de datos"
		}, {
			"id": 11,
			"categoria_id": 1,
			"subcategoria": "Gesti\u00f3n de base de datos"
		}, {
			"id": 12,
			"categoria_id": 1,
			"subcategoria": "Manejo del tiempo"
		}, {
			"id": 13,
			"categoria_id": 2,
			"subcategoria": "Comunidad Comercial UVM"
		}, {
			"id": 14,
			"categoria_id": 2,
			"subcategoria": "Microstrategy"
		}, {
			"id": 15,
			"categoria_id": 2,
			"subcategoria": "Blackboard"
		}, {
			"id": 16,
			"categoria_id": 2,
			"subcategoria": "Herramientas de venta"
		}, {
			"id": 17,
			"categoria_id": 3,
			"subcategoria": "Clima laboral"
		}, {
			"id": 18,
			"categoria_id": 3,
			"subcategoria": "Crecimiento"
		}, {
			"id": 19,
			"categoria_id": 3,
			"subcategoria": "Productividad"
		}],
		"calificacion_tips": [{
					"calificacion": "5.0000",
					"tip_id": 28
				}, 
				{...}
				]
				
		}
	}
	</pre>
</div>





<div>
	<h2>TMis INiciativas</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/misiniciativas</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"data": {
			"destreza": {
				"tecnicas_de_venta": [{
					"id": 56,
					"titulo": "CONFIANZA",
					"descripcion": "CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd como:\r\n\r\n- INSCRIPCIONES PARA TODAS LAS LINEAS \r\n- RECOMENDACIONES (YA QUE SE VUELVE TU PROMOTOR)\r\n- Y TE ASEGURA EL REINGRESO",
					"id_categoria": 1,
					"id_subcategoria": 6,
					"id_user": 48,
					"propuesta": "CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd",
					"orden_propuesta": 0,
					"evidencia_video": "",
					"evidencia_foto": "",
					"evidencia_texto": "",
					"is_active": "1",
					"votaciones": {
						"calificacion": null,
						"iniciativa_id": null
					},
					"propuestas": ["CONOCER TU PRODUCTO Y ESTAR CONVENCIDO DE QUE SOMOS LA MEJOR OPCI\u00d3N TE GENERA PROSPECTOS O UNA POSIBLE INSCRIPCI\u00d3N, PERO EL GANARTE LA CONFIANZA DE TU CLIENTE, Es lo mas importante ya que SABR\u00c1 que eres su \u00daNICA OPCI\u00d3N y con ello TE ASEGURA SU LEALTAD AS\u00cd como:\r\n\r\n- INSCRIPCIONES PARA TODAS LAS LINEAS \r\n- RECOMENDACIONES (YA QUE SE VUELVE TU PROMOTOR)\r\n- Y TE ASEGURA EL REINGRESO"],
					"indicadores": [1, 2, 7],
					"users": {
						"name": "Isabel",
						"campus": "Reynosa",
						"foto": ""
					}
				},
				{...}
			],
				"oferta_academica": [{...}],
				"generacion_de_base_de_datos": [{...}],
				"gestion_de_base_de_datos": [{...}],
				"manejo_del_tiempo": [{...}],
			},
					  
		"uso_de_herramientas": {
							"salesforce" : [{...}],
							"comunidad_comercial_uvm" : [{...}],
							"microstrategy" : [{...}],
							"blackboard" : [{...}],
							"herramientas_de_venta" : [{...}],
		},
		
		"desarrollo_de_talento" {
									 "colaboracion" : [{...}],
									"clima_laboral" : [{...}],
									"crecimiento" : [{...}],
									"productividad" : [{...}],
			}
			
		}
		
	}
	</pre>
</div>





<div>
	<h2>GUARDAR preguntas</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/guardar_pregunta</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	<p>pregunta (obligatorio)</p>
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		'mensaje': 'Pregunta guardada con exito'
	}
	</pre>
</div>



<div>
	<h2>GUARDAR respuesta</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/guardar_respuesta</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>respuesta (obligatorio)</p>
	<p>preguntas_id (obligatorio)</p>
	<p>quien_pregunto (obligatorio)</p>
	
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		'mensaje': 'Respuesta guardada con exito'
	}
	</pre>
</div>




<div>
	<h2>listar preguntas y respuestas</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/preguntas_respuestas</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>respuesta (obligatorio)</p>
	<p>preguntas_id (obligatorio)</p>
	<p>quien_pregunto (obligatorio)</p>
	
	
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"preguntas": [],
		"respuestas": []
	}
	</pre>
</div>





<div>
	<h2>GUARDAR VOTACIONES TIPS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/guardar_votaciones_tips</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>tip_id (obligatorio)</p>
	<p>calificacion (obligatorio)</p>
	<p>comentario (obligatorio)</p>
	
	 
	
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		'mensaje': 'La calificafion del tip fue recibida exitosamente'
	}
	</pre>
</div>






<div>
	<h2>GUARDAR VOTACIONES INICIATIVAS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/guardar_votaciones_iniciativas</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>iniciativas_id (obligatorio)</p>
	<p>calificacion (obligatorio)</p>
	<p>comentario (obligatorio)</p>
	
	 
	  
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		'mensaje': 'La calificafion de la iniciativa fue recibida exitosamente'
	}
	</pre>
</div>





<div>
	<h2>DETALLE INICIATIVA</h2>
	
	<p><b>@method GET</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/getDetailIniciativa</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>id (obligatorio)</p>
	
	
	 
	  
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"mensaje": "Detalle de iniciativa",
		"data": {
			"id": 41,
			"titulo": "Reforzamientos mensual de Producto por parte de los acad\u00e9micos",
			"descripcion": "El a\u00f1o pasado en el proyecto del Spartan Race de Conocimiento del 2015, lanzamos un reto en donde los acad\u00e9micos deber\u00edan darles clases a los equipos del \u00e1rea de Admisiones.\r\nLa experiencia vivida fue de las mejores rankeada entre todos los retos del Spartan. Muchos asesores pudieron vivir los laboratorios de los diferentes programas, aprender en las cocinas de Glion, entender qu\u00e9 se hac\u00eda en la sala de juicios orales, conocer a detalle la din\u00e1mica de la biblioteca, gimnasios, etc.\r\nLos expertos en el producto son los acad\u00e9micos, qui\u00e9n mejor que ellos para ayudarnos a perfeccionar el conocimiento de la oferta acad\u00e9mica y sobre todo de los programas nuevos.",
			"id_categoria": 1,
			"id_subcategoria": 9,
			"id_user": 16,
			"propuesta": "El a\u00f1o pasado en el proyecto del Spartan Race de Conocimiento del 2015, lanzamos un reto en donde los acad\u00e9micos deber\u00edan darles clases a los equipos del \u00e1rea de Admisiones.\r\nLa experiencia vivida fue de las mejores rankeada entre todos los retos del Spar",
			"orden_propuesta": 0,
			"evidencia_video": " https:\/\/laureate.jiveon.com\/videos\/1745",
			"evidencia_foto": "image003.png",
			"evidencia_texto": "",
			"is_active": "1",
			"indicadores": [{
				"id": 1,
				"titulo": "Nuevo Ingreso"
			}, {
				"id": 2,
				"titulo": "Precio"
			}, {
				"id": 6,
				"titulo": "Tasa de conversi\u00f3n cierre"
			}],
			"propuestas": ["El a\u00f1o pasado en el proyecto del Spartan Race de Conocimiento del 2015, lanzamos un reto en donde los acad\u00e9micos deber\u00edan darles clases a los equipos del \u00e1rea de Admisiones.\r\nLa experiencia vivida fue de las mejores rankeada entre todos los retos del Spartan. Muchos asesores pudieron vivir los laboratorios de los diferentes programas, aprender en las cocinas de Glion, entender qu\u00e9 se hac\u00eda en la sala de juicios orales, conocer a detalle la din\u00e1mica de la biblioteca, gimnasios, etc.\r\nLos expertos en el producto son los acad\u00e9micos, qui\u00e9n mejor que ellos para ayudarnos a perfeccionar el conocimiento de la oferta acad\u00e9mica y sobre todo de los programas nuevos."],
			"comments": [{
				"id": 5,
				"comentario": "Es una buena referencia de iniciativa",
				"id_iniciativa": 41,
				"id_user": 16,
				"created_at": "2016-09-05 00:29:10",
				"updated_at": "2016-09-05 00:29:10",
				"name": "Mari"
			}, {
				"id": 6,
				"comentario": "Me parece muy bien tu idea en mi campus tenemos capacitaciones muy pocas veces al a\u00f1o, es bueno estar enterado de lo que pasa y lo que ha cambiado en un lapso mas corto de tiempo.",
				"id_iniciativa": 41,
				"id_user": 43,
				"created_at": "2016-09-05 12:14:50",
				"updated_at": "2016-09-05 12:14:50",
				"name": "BLANCA ESTHELA "
			}]
		}
	}
	</pre>
</div>





<div>
	<h2>AGREGAR COMENTARIO</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/postComment</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>id_iniciativa (obligatorio)</p>
	<p>comentario (obligatorio)</p>
	
	
	  
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"mensaje": "Comentarios iniciativa",
		"data": [{
			"id": 5,
			"comentario": "Es una buena referencia de iniciativa",
			"id_iniciativa": 41,
			"id_user": 16,
			"created_at": "2016-09-05 00:29:10",
			"updated_at": "2016-09-05 00:29:10",
			"name": "Mari"
		}, 
		{...}
		]
	}
	</pre>
</div>



<div>
	<h2>BUSCAR - BUSCA EN TODAS LAS CATEGORIAS</h2>
	
	<p><b>@method POST</b></p>
	<p>https://secure.kreativeco.com/naat/public/api/postComment</p>
	
	<p><b>@params</b></p>
	<p>token (obligatorio)</p>
	
	<p>search (obligatorio)</p>
	
	
	  
	<p><b>@return</b></p>
	<pre>
	{
		"error": false,
		"mensaje": "Resultado de bsuquedaa",
		"data": {
			"destreza": {
				"tecnicas_de_venta": [],
				"oferta_academica": [{
					"id": 41,
					"titulo": "Reforzamientos mensual de Producto por parte de los acad\u00e9micos",
					"descripcion": "El a\u00f1o pasado en el proyecto del Spartan Race de Conocimiento del 2015, lanzamos un reto en donde los acad\u00e9micos deber\u00edan darles clases a los equipos del \u00e1rea de Admisiones.\r\nLa experiencia vivida fue de las mejores rankeada entre todos los retos del Spartan. Muchos asesores pudieron vivir los laboratorios de los diferentes programas, aprender en las cocinas de Glion, entender qu\u00e9 se hac\u00eda en la sala de juicios orales, conocer a detalle la din\u00e1mica de la biblioteca, gimnasios, etc.\r\nLos expertos en el producto son los acad\u00e9micos, qui\u00e9n mejor que ellos para ayudarnos a perfeccionar el conocimiento de la oferta acad\u00e9mica y sobre todo de los programas nuevos.",
					"id_categoria": 1,
					"id_subcategoria": 9,
					"id_user": 16,
					"propuesta": "El a\u00f1o pasado en el proyecto del Spartan Race de Conocimiento del 2015, lanzamos un reto en donde los acad\u00e9micos deber\u00edan darles clases a los equipos del \u00e1rea de Admisiones.\r\nLa experiencia vivida fue de las mejores rankeada entre todos los retos del Spar",
					"orden_propuesta": 0,
					"evidencia_video": " https:\/\/laureate.jiveon.com\/videos\/1745",
					"evidencia_foto": "image003.png",
					"evidencia_texto": "",
					"is_active": "1",
					"votaciones": {
						"calificacion": "5.0",
						"iniciativa_id": 0
					},
					"propuestas": ["El a\u00f1o pasado en el proyecto del Spartan Race de Conocimiento del 2015, lanzamos un reto en donde los acad\u00e9micos deber\u00edan darles clases a los equipos del \u00e1rea de Admisiones.\r\nLa experiencia vivida fue de las mejores rankeada entre todos los retos del Spartan. Muchos asesores pudieron vivir los laboratorios de los diferentes programas, aprender en las cocinas de Glion, entender qu\u00e9 se hac\u00eda en la sala de juicios orales, conocer a detalle la din\u00e1mica de la biblioteca, gimnasios, etc.\r\nLos expertos en el producto son los acad\u00e9micos, qui\u00e9n mejor que ellos para ayudarnos a perfeccionar el conocimiento de la oferta acad\u00e9mica y sobre todo de los programas nuevos."],
					"indicadores": [1, 2, 6],
					"users": {
						"name": "Mari",
						"campus": "Corporativo",
						"foto": "logo-naat-example.png"
					}
				}],
				"generacion_de_base_de_datos": [],
				"gestion_de_base_de_datos": [],
				"manejo_del_tiempo": []
			},
			"uso_de_herramientas": {
				"salesforce": [],
				"comunidad_comercial_uvm": [],
				"microstrategy": [],
				"blackboard": [],
				"herramientas_de_venta": []
			},
			"desarrollo_de_talento": {
				"colaboracion": [],
				"clima_laboral": [],
				"crecimiento": [],
				"productividad": []
			}
		}
	}
	</pre>
</div>

