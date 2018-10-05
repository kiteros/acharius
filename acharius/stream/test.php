<!DOCTYPE html>
<html>
<style>
.tooltip2 {
position: relative;
display: inline-block;
border-bottom: 1px dotted #8fabd8;
}

.tooltip2 .tooltiptext2 {
visibility: hidden;
width: 120px;
background-color: #8fabd8;
color: #fff;
text-align: center;
border-radius: 6px;
padding: 5px 0;
position: absolute;
z-index: 1;
top: -5px;
left: 110%;
}

.tooltip2 .tooltiptext2::after {
content: "";
position: absolute;
top: 50%;
right: 100%;
margin-top: -5px;
border-width: 5px;
border-style: solid;
border-color: transparent #8fabd8 transparent transparent;
}
.tooltip2:hover .tooltiptext2 {
visibility: visible;
}
</style>
<body style="text-align:center;">

<div class="tooltip2" style="text-align:center;">
<img src="img/questionsvg.svg" height="30px" width="30px"/>
 <span class="tooltiptext2">Texttt</span>
</div>

</body>
</html>
