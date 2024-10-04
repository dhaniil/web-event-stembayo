<!DOCTYPE html>
<html lang="en">
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<h2>Vue.js</h2>

<div id="app">
  {{ message }}
</div>

<p>
<button onclick="myFunction()">Click Me!</button>
</p>

<script>
var myObject = new Vue({
  el: '#app',
  data: {message: 'Hello Vue!'}
})

function myFunction() {
    myObject.message = "STM";
}
</script>


</body>
</html>