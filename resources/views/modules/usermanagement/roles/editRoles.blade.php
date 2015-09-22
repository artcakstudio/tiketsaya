@extends('template')
@section('content')
	@parent
<?php echo '<script> var ROLES_ID='.$id.'</script>'?>
<div class="matter">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="widget wgreen">	
            <div class="widget-content">
              <div class="padd">
                <br />
	                <div>
               		<h2>Modul</h2>
               		<table class="modul">
               			@foreach($modul as $row)
               				<tr style="height:50px">
               					<td class="modul" style="width:200px">{{$row['MODULES_NAME']}}_{{$row['SUB_MODULES_NAME']}}</td>
               					<td><button onclick='hapusModule("{{$row['MODULES_ID']}}","{{$row['SUB_MODULES_ID']}}")' class="btn btn-danger modul">Hapus</button></td>
               				</tr>
               			@endforeach
               		</table>
	                </div>

              </div>
            </div>
            <div class="widget-foot">
               <!-- Footer goes here -->
            </div>
          </div>  
        </div>

      </div>
    </div>
      <div class="row">
        <div class="col-md-12">
          <div class="widget wgreen">	
            <div class="widget-content">
              <div class="padd">
                <br />
	                <div>
               			<h1>List Modul</h1>
               			<select class="form-control modul" style="width:30%;float:left">
               				@foreach($allmodul as $row)
               				<option value="{{$row->SUB_MODULES_ID}}_{{$row->MODULES_ID}}">{{$row->MODULES_NAME}}_{{$row->SUB_MODULES_NAME}}</option>
               				@endforeach
               			</select>
               			<button class="btn btn-primary" style="margin-left:10px">Tambah Module</button>
	                </div>

              </div>

            <div class="widget-foot">
               <!-- Footer goes here -->
            </div>
          </div>  
        </div>
        
      </div>
</div>     
<div class="widget-foot" id="lalaa">
</div>
<script type="text/javascript">
var submodulename='';
	function hapusModule (modulid,subid) {
		
		$.ajax({
			type : "post",
			url : "<?php echo url('usermanagement/roles/hapusHakAkses')?>",
			data : {"MODULES_ID":modulid,"SUB_MODULES_ID":subid,'_token':token},
			datatype : "JSON",
			success:function(data){				
			$("select.form-control.modul").append('<option value="'+subid+'_'+modulid+'">'+submodulename+'</option>');
			}
		});
	}
	function animateAjax(){
		
	}
	$("button.modul").click(function(	){
		
		var a=this;
		var role=$(this.closest("tr")).get();
		var modul=$(role[0].children[0]).get();	
		submodulename=modul[0].innerHTML;
		a.closest("tr").remove();
	})
	$("table.modul ").on("click","button.modul",function(){
		var a=this;
		var role=$(this.closest("tr")).get();
		var modul=$(role[0].children[0]).get();	
		submodulename=modul[0].innerHTML;
		a.closest("tr").remove();
	});

	$("button.btn.btn-primary").click(function(){
		var value=$("select.form-control.modul").val();
		
		submodulename=$("select.form-control.modul :selected").text();
		$("select.form-control.modul :selected").remove();
		value=value.split('_');
		var subid=value[0];
		var modulid=value[1];
		$.ajax({
			type : "post",
			url : "<?php echo url('usermanagement/roles/tambahHakAkses')?>",
			data : {"MODULES_ID":modulid,"SUB_MODULES_ID":subid,'_token':token,'ROLES_ID':ROLES_ID},
			datatype : "JSON",
			success:function(data){				
				$("table.modul").append('<tr style="height:50px"><td class="modul" style="width:200px">'+submodulename+'</td><td><button onclick=hapusModule("'+modulid+'","'+subid+'") class="btn btn-danger modul" >Hapus</button></td></tr>');
			}
		
		});
	});
</script>

	@stop
