import { Component, OnInit } from '@angular/core';
import { UserService } from './service/user.service';
import { User } from './model/User';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})
export class MainComponent implements OnInit {
  user = new User('', '', '', '')
  // emailInput: String;
  // passwordInput: String;
  // nameInput: String;
  // dropdownInput: String;

  users: User[];

  constructor(private userService : UserService) { }

  ngOnInit() {
    this.get();
  }

  get() {
    // console.log(this.emailInput);
    this.userService.get().subscribe(
      (res)=> {
        console.log(res);
        this.users = res;
      }
    )
  }

  post() {
    console.log(this.user);
    this.userService.store(this.user).subscribe(
      (res)=> {
        console.log(res)
      }
    )
    
  }

}
