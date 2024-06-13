let fromFetcher = document.getElementById("txtFetchFrom");
let ToFetcher = document.getElementById("txtFetchTo");

$(function() {
    $("#txtregDate").datepicker({dateFormat:"yy-mm-dd"});
    $("#txtregDateFrom").datepicker({dateFormat:"yy-mm-dd"});
    $("#txtregDateTo").datepicker({dateFormat:"yy-mm-dd"});
});

function print_click(xtype){
    document.forms.myform.method = 'POST';
    document.forms.myform.target = '_blank';
    document.forms.myform.action = 'app/views/printFetcher.php';
    document.forms.myform.txt_repoutput.value = xtype;
    document.forms.myform.submit();
}
