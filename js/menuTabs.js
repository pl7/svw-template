function toggleContactTab(newActiveContactTab){
    
    if(currentContactTab != newActiveContactTab){
        
        $('#contact-page-item').removeClass(currentContactTab+'-tab');
        $('#tabMenu').removeClass('active-'+currentContactTab);
        $('#tabMenu li.'+currentContactTab).toggleClass('active');
        currentContactTab = newActiveContactTab;
        $('#contact-page-item').addClass(currentContactTab+'-tab');
        $('#tabMenu').addClass('active-'+currentContactTab);
        $('#tabMenu li.'+currentContactTab).toggleClass('active');
    }
    
}