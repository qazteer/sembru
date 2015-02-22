<!DOCTYPE html>
<html>
<head>
    <title>Test JavaScript</title>
    <script type="text/javascript">
        window.onload = function(){
            document.getElementById("paragraphs").onclick = function(){
                var arr = document.getElementsByTagName("p");
                for(var i=0; i<arr.length; i++){
                    arr[i].style.border = "1px solid #ff0000";
                    arr[i].style.color = "red";
                    arr[i].style.width = "100px";
                }
            }

            document.getElementById("links").onclick = function(){
                var arr = document.getElementsByTagName("a");
                for(var i=0; i<arr.length; i++){
                    arr[i].style.border = "1px solid #ff0000";
                    arr[i].style.color = "red";
                    arr[i].style.width = "100px";
                }
            }

            document.getElementById("divs").onclick = function(){
                var arr = document.getElementsByTagName("div");
                for(var i=0; i<arr.length; i++){
                    arr[i].style.border = "1px solid #ff0000";
                    arr[i].style.color = "red";
                    arr[i].style.width = "100px";
                }
            }

        }
    </script>
</head>
<body>


       <p>paragraph1</p>
       <a href="#">link1</a>
       <p>paragraph2</p>
       <a href="#">link2</a>
       <p>paragraph3</p>
       <a href="#">link3</a>
       <br><br>
       <div id="id_test">DIV</div>
       <br><br>
       <input id="paragraphs" type="button" value="выделить параграфы"/> <br><br>
       <input id="links" type="button" value="выделить ссылки"/> <br><br>
       <input id="divs" type="button" value="выделить дивы"/> <br><br>
</body>
</html>