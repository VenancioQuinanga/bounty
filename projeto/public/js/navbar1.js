"use strict"
const firstCloser = document.querySelector('.first-closer')
const secondCloser = document.querySelector('.second-closer')
const aside = document.querySelector("aside nav#dropdown")

firstCloser.addEventListener("click",()=>{
    if (aside.style.display == "block") {
        aside.style.display = ""

    } else{

        aside.style.display = "block"
    }
})

secondCloser.addEventListener("click",()=>{
    if (aside.style.display == "block") {
        aside.style.display = ""

    } else{

        aside.style.display = "block"
    }
})
