import { Injectable } from "@angular/core";
import 'rxjs/add/operator/map';
import {Headers} from "@angular/http";
import { Http } from "@angular/http";
@Injectable({
  providedIn: "root"
})
export class AppartooService {
  constructor(private http: Http) {

    
  }

  

  login(login, password) {
    return this.http.get(
      "http://localhost:8000/loginapi/" + login + "/" + password
    ).map(resp=>resp.json());
  }

  register(ressource){
    let headers = new Headers();
    return this.http.post('http://localhost:8000/registerapi',ressource).map(resp=>resp.json());;
  }


  get(id){
    return this.http.get('http://localhost:8000/getMarsupilami/'+id).map(resp=>resp.json());
  }

  getAll(){
    return this.http.get('http://localhost:8000/allapi').map(resp=>resp.json());
  }


  update(id,ressource){
    return this.http.put('http://localhost:8000/modifapi/'+id,ressource).map(resp=>resp.json());
  }

  AddAmis(ressource){
    return this.http.post('http://localhost:8000/adapi/'+ressource.id1+'/'+ressource.id2,ressource);
  }

  SupAmis(ressource){
    return this.http.post('http://localhost:8000/supapi/'+ressource.id1+'/'+ressource.id2,ressource);
  }
}
