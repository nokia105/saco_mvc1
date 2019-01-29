
<form method="post" class="pass_change">

	  {{ csrf_field() }}

	   <div class="ceneter" style="text-align: center; padding-bottom:5px;">
                                <h4>Password Change</h4>
                           </div>
	<div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}"> <!-- Date input -->
        <label class="control-label" for="date">Old Password</label>
        <input  class="form-control"  type="password" name="oldpassword" id="oldpassword">
        <small class="text-danger">{{ $errors->first('oldpassword')}}</small>
      </div>
      <div class="form-group"> <!-- Date input -->
        <label class="control-label">New Password</label>
        <input  class="form-control"  type="password" name="password">
      </div>

      <div class="form-group"> <!-- Date input -->
        <label class="control-label" >Confirm Password</label>
        <input  class="form-control"  type="password" name="password_confirmation">
      </div>
    <div class="form-row col-md-12">
                <div class="form-group col-md-12">
                <input type="submit"  value="update" class="btn btn-info col-md-offset-3 col-md-3"  style="margin-top: 20px;">
              </div>
            </div>
    </form>
</form>


  <script>


      

$('.pass_change').submit( function (ev) {
    ev.preventDefault();

  
  if($('#oldpassword').val() == ''){
      alert(' exam is required');
      ev.preventDefault();
               return false;
   }
else {

  

      $.ajax({
      type:"GET",
      url:"{{route('pass_change',$id)}}",
      data:$('.pass_change').serialize(),
      
      success:function(data){
          
       $('.pass_change').html(data);     
         
      }

    });
    return;

   }
});

</script>
