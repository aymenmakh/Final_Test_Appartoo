import { Component, OnInit } from '@angular/core';
import { AppartooService } from '../Services/Appartoo.service';
import {Router} from "@angular/router";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

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
  }

  doRegister(){
    this.marsupilami.salt =this.marsupilami.password
    this.marsupilami.email_canonical = this.marsupilami.email
    this.service.register(this.marsupilami).subscribe(response =>{
         console.log(response)
         localStorage.setItem("id",JSON.stringify(response[0]));
         this.router.navigate(['profile',response[0]])
    });
  
 
}


}
