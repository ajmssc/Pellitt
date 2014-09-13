var menuArrowOffset;
var menuOpened = false;
var menuCurrent = '';

var menuContainer;
var menuShadow;
var menuArrow;

var menuContainerOffset = {'top':14,'left':30};
var menuArrowOffset = {'top':0,'left':6}

$(document).ready(function() {initMenu();});

function initMenu() {
    menuContainer = $('#menuMaster');
    menuShadow = $('#menuShadow');
    menuArrow= $('#dropdownArrow');
    
    $('.menuItem').on('click',function(){menuClick(event);});
    $('#settingsButton').on("mousedown",function(){toggleMenu('settings');});
}

function toggleMenu(menuName) {
    var currentButton = $('#'+menuName+'Button');
    //close the menu instead
    if(menuCurrent == menuName && menuOpened) {
        closeMenu();
    } else {
        menuContainer.show();
        menuShadow.show();
        menuArrow.show();
        menuOpened = true;
        menuCurrent = menuName;
        
        menuArrow.css('left', currentButton.offset().left+currentButton.width()/2-menuArrowOffset.left)
                 .css('top',currentButton.offset().top+currentButton.height()+menuArrowOffset.top);      
        $('#settingsMenuContainer').show();
        menuContainer.css('top',currentButton.offset().top+currentButton.height()+menuContainerOffset.top)
                     .css('left',currentButton.offset().left-menuContainer.width()+menuContainerOffset.left);
        menuShadow.width(menuContainer.width()).height(menuContainer.height())
                  .css('left',menuContainer.offset().left)
                  .css('top',menuContainer.offset().top);
    }
}

function closeMenu() {
    menuContainer.hide();
    menuShadow.hide();
    menuArrow.hide();
    menuOpened = false;
    menuCurrent = '';
}

function hideAllMenuPanes() {
    $('#'+menuName+'MenuContainer').hide();
}

function menuClick(event) {
    alert(event.target.id);
}