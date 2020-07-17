$(document).ready(function(){
    $('.deleteForm').click(function(evt){
        var id=$(this).data("id");
        var form=$(this).closest("form");
        evt.preventDefault();
        swal({
            title:`คุณต้องการลบข้อมูลที่ ${id} หรือไม่ ?`,
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