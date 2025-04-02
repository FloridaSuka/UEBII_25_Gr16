var x=document.getElementById("login");
var y=document.getElementById("register");
var z=document.getElementById("btn");

function register(){
    x.style.left="-400px";
    y.style.left="50px";
    z.style.left="110px";
}
function login(){
    x.style.left="50px";
    y.style.left="450px";
    z.style.left="0px";
}

const audio = new Audio();
// Përdorim replace() për të ndryshuar string-un e `src` të `audio` pa ndryshuar strukturën e kodit
audio.src = ".click.mp3".replace(".click", ".click");  // Këtu mund të bëjmë manipulime të tjera të string-ut në të ardhmen
