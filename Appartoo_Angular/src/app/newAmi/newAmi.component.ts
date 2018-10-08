import { Component, OnInit } from '@angular/core';
import { AppartooService } from '../Services/Appartoo.service';
import {Router} from "@angular/router";

@Component({
  selector: 'app-newAmi',
  templateUrl: './newAmi.component.html',
  styleUrls: ['./newAmi.component.css']
})
export class NewAmiComponent implements OnInit {
  marsupilami = {
    username :null,
    password : null,
    email : null,
    age : null,
    email_canonical : null,
    salt : null,
    famille :null,
    couleur : null,
    nourriture : null,
  };
  passwordR : any ;
  constructor(private service:AppartooService,private router: Router) { }

  ngOnInit() {
    if(localStorage.getItem('id')==null)  this.router.navigate(['login'])
  }

  doRegister(){
    this.marsupilami.salt =this.marsupilami.password
    this.marsupilami.email_canonical = this.marsupilami.email
    this.service.register(this.marsupilami).subscribe(response =>{
         console.log(response)
         this.adamis(localStorage.getItem('id'),response[0])
         this.router.navigate(['amis'])
    });
  
 
}

adamis(id1, id2) {
  let ressource = {
    id1: id1,
    id2: id2
  };
  this.service.AddAmis(ressource).subscribe(resp => {});
}

}
