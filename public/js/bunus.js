$(document).ready(function(){
    $('.deleteForm').click(function(evt){
        var Issuesid=$(this).data("Issuesid");
        var form=$(this).closest("form");
        evt.preventDefault();
        swal({
            title:`คุณต้องการลบข้อมูลหรือไม่ ?`,
            text:"ถ้าลบแล้วข้อมูลไม่สามารถกู้คืนได้",
            icon:"warning",
            buttons:true,
            dangerMode:true
        }).then((willDelete)=>{
            if(willDelete){
                form.submit();                 
            }              
        });
    });
});