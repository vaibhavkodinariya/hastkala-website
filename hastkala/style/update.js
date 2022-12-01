function CheckAll(checkbox) {
    let checkboxes = document.getElementsByClassName("Check-item");

    for (let i = 0; i < checkboxes.length; i++)
        checkboxes[i].checked = checkbox.checked;
      }

function CheckItem() {
    let checkboxes = document.getElementsByClassName("Check-item");
    let allChecked = true;

    for (let i = 0; i < checkboxes.length; i++) {
        if (!checkboxes[i].checked) {
            allChecked = false;
            break;
        }
    }

    document.getElementById("Check-all").checked = allChecked;
}
function check(checkbox) {
    let checkboxes = document.getElementsByClassName("Checkitem");

    for (let i = 0; i < checkboxes.length; i++)
        checkboxes[i].checked = checkbox.checked;
      }

function checkthisItem() {
    let checkboxes = document.getElementsByClassName("Checkitem");
    let allChecked = true;

    for (let i = 0; i < checkboxes.length; i++) {
        if (!checkboxes[i].checked) {
            allChecked = false;
            break;
        }
    }

    document.getElementById("Checkall").checked = allChecked;
}
$(document).ready(function()
      {
    $('.carousel').carousel();
    $('select').formSelect();
    $('#UpdateCategory').on('change',function(){
        var catid = document.getElementById("UpdateCategory").value;
            var categoryHeader = {url: "./getSubCategory.php?catid="+catid};
            $.ajax(categoryHeader).done((data)=>{
                $('select#UpdateSubcategory').attr('disabled', false);
                var d = data.data;
                console.log(d);
                var html = "<option disabled selected value=''>choose a subcategory</option>'";
                for (var i = 0; i < d.length; i++) {
                    html += "<option value='" + d[i][0] + "'>" + d[i][1] + "</option>";
                    if(d[i][0]==5)
                    {
                        
                        $('#UpdateSubcategory').on('change',function(){
                            var ca = document.getElementById('UpdateSubcategory');
                            var sca = ca.options[ca.selectedIndex].value;
                            if(sca == 5)
                            {
                                document.getElementById("SizeOfTraditionalWear").className = "row";
                                document.getElementById("SizeOfFootwear").className = "hide row";
                                document.getElementById("Checkall").checked=false;
                                $('.Checkitem').prop('checked',false);
                            }
                            else if(sca == 7)
                            {
                                document.getElementById("SizeOfFootwear").className = "row";
                                document.getElementById("SizeOfTraditionalWear").className = "hide row";
                                document.getElementById("Check-all").checked=false;
                                $('.Check-item').prop('checked',false);
                            }
                            else
                            {
                                document.getElementById("SizeOfTraditionalWear").className = "hide row";
                                document.getElementById("SizeOfFootwear").className = "hide row";
                            }
                        })
                    }
                }
                $("#UpdateSubcategory").html(html);
                $('select').formSelect();
            })
        })
        $('.sidenav').sidenav();
        $('.tabs').tabs();
        $('input#input_text , textarea#textarea1').characterCounter();
        $('.collapsible').collapsible();
    $("select[required]").css({display:"block",height: 0,padding: 0, width: 0,position: 'absolute'});
    $("radio[required]").css({display:"block",height: 0,padding: 0, width: 0,position: 'absolute'});
});