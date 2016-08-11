$(document).ready(function(){

    $('#plan_id').change(function(){
        if (!this.value) {
            $('#plan_info').html('');
            return false;
        }
       $('#plan_info').load(url + 'companies/'+this.value+'/plan-info');
    });
});