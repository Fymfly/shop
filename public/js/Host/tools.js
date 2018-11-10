function get(name) {

    let re = new RegExp(name+"=([^&]*)");
    let res = location.search.match(re)
    if(res)
        return res[1]
    else    
        return ''
}