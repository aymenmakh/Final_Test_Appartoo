import { Params } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { AppartooService } from '../Services/Appartoo.service';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';

@Component({
  selector: 'app-update',
  templateUrl: './update.component.html',
  styleUrls: ['./update.component.css']
})
export class UpdateComponent implements OnInit {
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
  id : any;
  constructor(private service:AppartooService,private route: ActivatedRoute,private router: Router) { }

  ngOnInit() {
    if(localStorage.getItem('id')==null)  this.router.navigate(['login'])
    this.route.params.subscribe((params: Params) => {
      this.id = params["id"];
    });
    this.service.get(this.id).subscribe(resp =>{
      var other = this;
      this.marsupilami =resp
     // console.log(this.marsupilami)
    })
    this.marsupilami.salt =this.marsupilami.password
    this.marsupilami.email_canonical = this.marsupilami.email

  }

  doUpdate(){
    this.marsupilami.salt =this.marsupilami.password
    this.marsupilami.email_canonical = this.marsupilami.email
    this.service.update(this.id,this.marsupilami).subscribe(resp=>{
      console.log(resp)
          this.router.navigate(['profile',this.id])
        
    })    
  }

}
