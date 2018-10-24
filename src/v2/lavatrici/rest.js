class requestFactory {

    constructor(path){
        this.path = path
    }

    serialize(obj) {
        var str = [];
        for (var p in obj)
          if (obj.hasOwnProperty(p)) {
            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
          }
        return str.join("&");
      }

    fetch(method,path,payload) {
        var self = this
        return new Promise(function (resolve, reject) {
            let xhttp = new XMLHttpRequest()
            xhttp.open(method, self.path+path, true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.send(self.serialize(payload))

            xhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    if (this.status == 200)
                        resolve(JSON.parse(this.responseText));
                    else
                        reject()
                }
            };

        })
    }
}