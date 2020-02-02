<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>System de News</title>
</head>
<style>
form {
    margin-top:30px;
    display: none;
    
}
.correct {
    border: 1px solid green;
}
.incorrect {
    border: 1px solid red;
}
h2{
    font-family : Arial;
}
</style>
<body>
   <h2>Books System (PHP POO & JS & AJAX)</h2>
    <button type="submit" id="btn1">Add a new Book</button>
    <button type="submit" id="btn2">Delete a Book</button>
    <button type="submit" id="btn3">Show a Book</button>

    <br>
    <form action="" method="post" id="form1">
    <h2>Add a new Book</h2>
    <table>
    <tr>
    <td>Author : </td>
    <td><input type="text" name="auteur" id="auteur"></td>
    </tr>
    <tr>
    <td>Title : </td>
    <td><input type="text" name="titre" id="titre"></td>
    </tr>
    <tr>
    <td>Details : </td>
    <td><textarea name="contenu" id="contenu" cols="30" rows="10"></textarea></td>
    </tr>
    <tr>
    <td><input type="submit" value="submit" id="submit1"></td>
    <td><input type="submit" value="Hide" id="hide1"></td>
    </tr>

    </table>

    <p id="paragraph_1"></p>
    </form>

    <form action="" method="post" id="form2">
    <h2>Delete a news</h2>
    <table>
    <tr>
    <td>ID : </td>
    <td><input type="number" name="id1" id="id1"></td>
    </tr>
    <tr>
    <td><input type="submit" value="submit" id="submit2"></td>
    <td><input type="submit" value="Hide" id="hide2"></td>
    </tr>
    </table>
    <p id="paragraph_2"></p>
    </form>

    <form action="" method="post" id="form3">
    <h2>Show a news</h2>
    <table>
    <tr>
    <td>ID : </td>
    <td><input type="number" name="id2" id="id2"></td>
    </tr>
    <tr>
    <td><input type="submit" value="submit" id="submit3"></td>
    <td><input type="submit" value="Hide" id="hide3"></td>
    </tr>
    </table>
    <p id="paragraph_3"></p>
    </form>

     <script>
     const btn1 = document.getElementById('btn1');
     const btn2 = document.getElementById('btn2');
     const btn3 = document.getElementById('btn3');
     const form1 = document.getElementById('form1');
     const form2 = document.getElementById('form2');
     const form3 = document.getElementById('form3');
     const auteur = document.getElementById('auteur');
     const titre = document.getElementById('titre');
     const contenu = document.getElementById('contenu');
     const id_1 = document.getElementById('id1');
     const id_2 = document.getElementById('id2');
     const xhr = new XMLHttpRequest();
     const hide1 = document.getElementById('hide1');
     const hide2 = document.getElementById('hide2');
     const hide3 = document.getElementById('hide3');
     let check1 = [true, true, true];
     let check2 = [true];
     let check3 = [true];
       btn1.addEventListener('click', () => {
        form1.style.display = "block";
       });

       btn2.addEventListener('click', () => {
        form2.style.display = "block";
       });

       btn3.addEventListener('click', () => {
        form3.style.display = "block";
       });

       auteur.addEventListener('blur', () => {
           if(auteur.value != "") {
               if(auteur.value.length < 5) {
                   auteur.className = "incorrect";
                   check1[0] = false;
               }else{
                auteur.className = "correct";
                check1[0] = true;
               }
           }else{
            auteur.className = "incorrect";
                   check1[0] = false;

           }

       });
       titre.addEventListener('blur', () => {
           if(titre.value != "") {
               if(titre.value.length < 5) {
                titre.className = "incorrect";
                check1[1] = false;
               }else{
                titre.className = "correct";
                check1[1] = true;
               }
           }else{
            titre.className = "incorrect";
                   check1[0] = false;
           }

       });
       contenu.addEventListener('blur', () => {
           if(contenu.value != "") {
               if(contenu.value.length < 5) {
                contenu.className = "incorrect";
                check1[2] = false;
               }else{
                contenu.className = "correct";
                check1[2] = true;
               }
           }else{
            contenu.className = "incorrect";
                   check1[0] = false;
           }

       });
       id_1.addEventListener('blur', () => {
        if(id_1.value == "") {
                id_1.className = "incorrect";
                check2[0] = false;
               }else{
                id_1.className = "correct";
                check2[0] = true;
               }
           

       });
       id_2.addEventListener('blur', () => {
           if(id_2.value == "") {
                id_2.className = "incorrect";
                check3[0] = false;
               }else{
                id_2.className = "correct";
                check3[0] = true;
               }
           

       });
       
       form1.addEventListener('submit', (e) => {
           e.preventDefault();
           if(check1[0] == true && check1[1] == true && check1[2] == true) {
               xhr.open('POST', 'config.php', true);
               xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
               xhr.send('auteur=' + auteur.value + '&titre=' + titre.value + '&contenu=' + contenu.value );
            xhr.addEventListener('readystatechange', () => {
            if(xhr.status == 200 && xhr.readyState == 4) {
               document.getElementById('paragraph_1').innerHTML = xhr.responseText;
            }
            
            });

           }else{
            document.getElementById('paragraph_1').textContent = "Error :)";
           }

           form1.reset();
       });

       form2.addEventListener('submit', (e) => {
           e.preventDefault();
           if(check2[0] == true) {
               xhr.open('POST', 'config.php', true);
               xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
               xhr.send('id1=' + id_1.value);
            xhr.addEventListener('readystatechange', () => {
            if(xhr.status == 200 && xhr.readyState == 4) {
                document.getElementById('paragraph_2').innerHTML = xhr.responseText;
            }
          
            });

           }else{
            document.getElementById('paragraph_2').textContent = "Error :)";
           }
     form2.reset();

       });

       form3.addEventListener('submit', (e) => {
           e.preventDefault();
           if(check3[0] == true) {
               xhr.open('POST', 'config.php', true);
               xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
               xhr.send('id2=' + id_2.value);
            xhr.addEventListener('readystatechange', () => {
            if(xhr.status == 200 && xhr.readyState == 4) {
                document.getElementById('paragraph_3').innerHTML = xhr.responseText;
            }
            
            });

           }else{
            document.getElementById('paragraph_3').textContent  = "Error :)";
           }
           form3.reset();

       });

       hide1.addEventListener('click', () => {
        form1.style.display = "none";
       });

       hide2.addEventListener('click', () => {
        form2.style.display = "none";
       });

       hide3.addEventListener('click', () => {
        form3.style.display = "none";
       });
     </script>
</body>
</html>