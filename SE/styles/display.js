var textSales = document.getElementById("sales-text");
var textReport = document.getElementById("report-text");
var textInventory = document.getElementById("inventory-text");
var textSettings = document.getElementById("settings-text");
var textUser = document.getElementById("user-text");
var textExit = document.getElementById("exit-text");

function MoveSales(){
    textSales.innerHTML = "SALES";
}

function MoveReport(){
    textReport.innerHTML = "REPORTS";
}

function MoveInventory(){
    textInventory.innerHTML = "INVENTORY";
}

function MoveSettings(){
    textSettings.innerHTML = "SETTINGS";
}

function MoveUser(){
    textUser.innerHTML = "SWITCH USER";
}

function MoveExit(){
    textExit.innerHTML = "EXIT";
}

function Leave(){
    textSales.innerHTML = "";
    textReport.innerHTML = "";
    textInventory.innerHTML = "";
    textSettings.innerHTML = "";
    textUser.innerHTML = "";
    textExit.innerHTML = "";
}