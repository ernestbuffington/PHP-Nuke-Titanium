<?php
global $theme_name;
echo "\n\n/* themes/".$theme_name."/css/drop_down_menu.php Fly Kit for PHP-Nuke Titanium - Design Themes On The Fly */\n"; 
echo "/* When we are done we will move this code to style.css */\n\n"; 
global $screen_width, $screen_height;
?>
@import url('https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i');

html{
   height:100%;
   width:100%;
}

html, body{
  padding: 0;
  margin: 0;
  font-family: 'Raleway', sans-serif;
}

body{
   background: linear-gradient(to bottom,#f9fbf7, #C9D8FF);
   height:100%;
   display:table;
   width:100%;
   text-align:center;
}

.table_center{
  display:table-cell;
  vertical-align: middle;
}
.drop-down{
    display: inline-block;
    position: relative;
}

.drop-down__button{
  background: linear-gradient(to right,#3d6def, #8FADFE);
  display: inline-block;
  line-height: 40px;
  padding: 0 18px;
  text-align: left;
  border-radius: 4px;
  box-shadow: 0px 4px 6px 0px rgba(0,0,0,0.2);
  cursor: pointer;
}

.drop-down__name {
    font-size: 9px;
    text-transform: uppercase;
    color: #fff;
    font-weight: 800;
    letter-spacing: 2px;
}

.drop-down__icon {
    width: 18px;
    vertical-align: middle;
    margin-left: 14px;
    height: 18px;
    border-radius: 50%;
    transition: all 0.4s;
  -webkit-transition: all 0.4s;
  -moz-transition: all 0.4s;
  -ms-transition: all 0.4s;
  -o-transition: all 0.4s;
  
}



.drop-down__menu-box {
    position: absolute;
    width: 100%;
    left: 0;
    background-color: #fff;
    border-radius: 4px;
  box-shadow: 0px 3px 6px 0px rgba(0,0,0,0.2);
     transition: all 0.3s;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  -ms-transition: all 0.3s;
  -o-transition: all 0.3s;
 visibility: hidden;
opacity: 0;
  margin-top: 5px;
}

.drop-down__menu {
    margin: 0;
    padding: 0 13px;
    list-style: none;
  
}
.drop-down__menu-box:before{
  content:'';
  background-color: transparent;
  border-right: 8px solid transparent;
  position: absolute;
  border-left: 8px solid transparent;
  border-bottom: 8px solid #fff;
  border-top: 8px solid transparent;
  top: -15px;
  right: 18px;

}

.drop-down__menu-box:after{
  content:'';
  background-color: transparent;
}

.drop-down__item {
    font-size: 13px;
    padding: 13px 0;
    text-align: left;
    font-weight: 500;
    color: #909dc2;
    cursor: pointer;
    position: relative;
    border-bottom: 1px solid #e0e2e9;
}

.drop-down__item-icon {
    width: 15px;
    height: 15px;
    position: absolute;
    right: 0px;
    fill: #8995b6;
  
}

.drop-down__item:hover .drop-down__item-icon{
  fill: #3d6def;
}

.drop-down__item:hover{
  color: #3d6def;
}



.drop-down__item:last-of-type{
  border-bottom: 0;
}


.drop-down--active .drop-down__menu-box{
visibility: visible;
opacity: 1;
  margin-top: 15px;
}

.drop-down__item:before{
  content:'';
  position: absolute;
width: 3px;
height: 28px;
background-color: #3d6def;
left: -13px;
top: 50%;
transform: translateY(-50%);
  display:none;
}

.drop-down__item:hover:before{
  display:block;
}
<?
