function checkAll(checkbox) {
    let checkboxes = document.getElementsByClassName("check-item");

    for (let i = 0; i < checkboxes.length; i++)
        checkboxes[i].checked = checkbox.checked;
      }

function checkItem() {
    let checkboxes = document.getElementsByClassName("check-item");
    let allChecked = true;

    for (let i = 0; i < checkboxes.length; i++) {
        if (!checkboxes[i].checked) {
            allChecked = false;
            break;
        }
    }

    document.getElementById("check-all").checked = allChecked;
}
function check(checkbox) {
    let checkboxes = document.getElementsByClassName("checkitem");

    for (let i = 0; i < checkboxes.length; i++)
        checkboxes[i].checked = checkbox.checked;
      }

function checkthisItem() {
    let checkboxes = document.getElementsByClassName("checkitem");
    let allChecked = true;

    for (let i = 0; i < checkboxes.length; i++) {
        if (!checkboxes[i].checked) {
            allChecked = false;
            break;
        }
    }

    document.getElementById("checkall").checked = allChecked;
}
$(document).ready(function()
      {
    $('select').formSelect();
        $('#category').on('change',function(){
            var catid = document.getElementById("category").value;
            var categoryHeader = {url: "./getSubCategory.php?catid="+catid};
                $.ajax(categoryHeader).done((data)=>{
                    $('select#subcategory').attr('disabled', false);
                    var d = data.data;
                    console.log(d);
                    var html = "<option disabled selected value=''>choose a subcategory</option>'";
                    for (var i = 0; i < d.length; i++) {
                        html += "<option value='" + d[i][0] + "'>" + d[i][1] + "</option>";
                        if(d[i][0]==5)
                        {

                            $('#subcategory').on('change',function(){
                            var ca = document.getElementById('subcategory');
                            var sca = ca.options[ca.selectedIndex].value;
                            if(sca == 5)
                                {
                                    document.getElementById("sw").className = "row";
                                    document.getElementById("sf").className = "hide row";
                                    document.getElementById("checkall").checked=false;
                                    $('.checkitem').prop('checked',false);
                                }
                            else if(sca == 7)
                            {
                                document.getElementById("sf").className = "row";
                                document.getElementById("sw").className = "hide row";
                                document.getElementById("check-all").checked=false;
                                $('.check-item').prop('checked',false);
                            }
                            else
                            {
                                document.getElementById("sw").className = "hide row";
                                document.getElementById("sf").className = "hide row";
                            }
                            })
                        }
                }
                $("#subcategory").html(html);
                $('select').formSelect();
                })
        });
            
    $('.sidenav').sidenav();
	$('.tabs').tabs();
    $('input#input_text , textarea#textarea1').characterCounter();
    $('.collapsible').collapsible();
    $("select[required]").css({display:"block",height: 0,padding: 0, width: 0,position: 'absolute'});
    $("radio[required]").css({display:"block",height: 0,padding: 0, width: 0,position: 'absolute'});
});