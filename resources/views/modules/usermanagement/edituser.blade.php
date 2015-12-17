@extends('template')
@section('content')
	@parent
<div class="matter" id="formAddUser">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="widget wgreen">	
                <div class="widget-content">
                  <div class="padd">
                    <br />
                    <!-- Form starts.  -->
                     {!!Form::open(['route'=>'usermanagement..update', 'METHOD'=>'POST','class'=>'form-horizontal'] )!!}
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Nama User</label>
				          <div class="col-lg-5">
				            <input type="text" class="form-control" value="{{$user['USERS_NAME']}}" name="USERS_NAME">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Username</label>
				          <div class="col-lg-5">
				            <input type="text" class="form-control" value="{{$user['USERS_USERNAME']}}" name="USERS_USERNAME">
				          </div>
				        </div>
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Password</label>
				          <div class="col-lg-5">
				            <input type="password" class="form-control"  name="USERS_PASSWORD">
				          </div>
				        </div>
				        
				        <div class="form-group">
				          <label class="col-lg-2 control-label">Email</label>
				          <div class="col-lg-5">
				            <input class="form-control" value="{{$user['USERS_EMAIL']}}" name="USERS_EMAIL" type="email">
				          </div>
				        </div>

				        <div class="form-group">
				          <label class="col-lg-2 control-label">HAK AKSES</label>
				          <div class="col-lg-5">
				          <select class="form-control role">
				          		@foreach($role as $row)
				          			<option value="{{$row['ROLES_ID']}}">{{$row['ROLES_NAME']}}</option>
				          		@endforeach
				          </select>
				          </div>
				          <span class="btn  btn-success" onclick="tambahRole()">Tambah</span>
				        </div>

				        <div class="form-group">    
				          <div class="col-lg-offset-2 col-lg-6">
				          	<table class="role">
					          	@foreach($userrole as $row)
				          		<tr id="{{$row['ROLES_ID']}}">
					          		<td style="width:200px"><span style="font-size:25px">{{$row['ROLES_NAME']}}</span>
					          		<td><div class="btn  btn-danger" onclick="hapusRole({{$row['ROLES_ID']}})">Hapus</div></td>
				          		</tr>
					          	@endforeach
				          	</table>
          				   </div>
        				</div>

				        <div class="form-group">    
				        <label></label>
				        <div class="form-group">
				          <div class="col-lg-offset-2 col-lg-6">
				            <button type="submit"  class="btn btn-sm btn-primary">Edit User</button>
          				   </div>
        				</div>
      				{!!Form::close()!!}
                  </div>
                </div>
                  <div class="widget-foot">
                    <!-- Footer goes here -->
                  </div>
              </div>  

            </div>

          </div>

        </div>
		  </div>


    
      </div>
      </div>      
      <div class="widget-foot" id="lalaa">
      </div>
<?php echo '<script> var id_user='.$user['USERS_ID'].'; var token="'.csrf_token().'"</script>'?>
<script type="text/javascript">
	function hapusRole(id){
		$.ajax({
			type : "post",
			url : "<?php echo url('usermanagement/hapusrole')?>",
			data : {"USERS_ID":id_user, "ROLES_ID":id,'_token':token},
			datatype : "JSON",
			success:function(data){
				var role=$("tr#"+id+" td span").html();
				$("select.form-control.role ").append('<option value="'+id+'">'+role+'</option>');
				$("tr#"+id).remove();
				alert(data.pesan);
			}
		});
	}
	function tambahRole () {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var id=$("select.role").val();
		var role=$(".role option[value="+id+"]");
		$.ajax({
			type : "post",
			url : "<?php echo url('usermanagement/tambahRole')?>",
			data : {"ROLES_ID":id,"USERS_ID":id_user,'_token':token},
			datatype : "JSON",
			success:function(data){
				data=jQuery.parseJSON(data);
				$("table").append('<tr id="'+id+'"><td style="width:200px"><span style="font-size:25px">'+role[0].innerHTML+'</span><td><div class="btn  btn-danger" onclick=hapusRole('+id+')>Hapus</div></td></tr>');
				role.remove();
				alert(data.pesan);
			}
		});
	}
</script>
	@stop
