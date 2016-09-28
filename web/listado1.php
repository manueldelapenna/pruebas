

        <div>
    
                <a href="formAgregarPersona.php" class="btn btn-info">Agregar Persona</a>
                <a href="mayor.php" class="btn btn-info">Mayor Edad</a>
                <a href="menor.php" class="btn btn-info">Menor Edad</a>
    
            <br>
            <br/>


            <input type="text" placeholder="Buscar" id="busqueda" onkeyup="filterPerson()" name="busqueda"><br/><br/>


            <br/><br/>
            <label>Items Pagina</label>    
            <select id="cantItems">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
            <input type="hidden" value="id" id="ordenActual">
            <input type="hidden" value="ASC" id="direccionActual">
            <table class="table">
                <thead class="head-table">
                    <tr>
                        <th><a name="id"><span class="glyphicon glyphicon-circle-arrow-up"></span>ID</a></th>
                        <th><a name="nombre"><span></span>Nombre</a></th>
                        <th><a name="apellido"><span></span>Apellido</a></th>
                        <th><a name="edad"><span></span>Edad</a></th>
                        <th><a name="fecha_nacimiento"><span></span>Año Nacimiento</a></th>
                        <th><a name="dni"><span></span>Dni</a></th>
                        <th>Acciones</th>
                    </tr>
                </thead>    
                <tbody class="body-table"> 

                </tbody>
            </table>
        </div>

        <div>
            <input type="hidden" value="1" id="paginaActual">
            <ul class="pagination">

            </ul>

        </div> 




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Datos de la persona</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    
