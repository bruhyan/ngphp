import { Injectable } from '@angular/core';
import { HttpClient, HttpEvent, HttpResponse, HttpEventType} from '@angular/common/http';
import { map } from 'rxjs/operators';
import { error } from 'util';
@Injectable({
  providedIn: 'root'
})
export class UploadService {

  server_url = "http://localhost/ngphp/"
  files;

  constructor(private httpClient: HttpClient) { }

  public uploadFile(data) {
    return this.httpClient.post<any>(this.server_url+'upload', data).pipe(
      map((res)=> {
        if(res['data'].error == true) {
           return new Error("error during upload");
         }else if(res['data'].error == false) {
           return this.files;
         }
      })
    )
    
  }

  public getUploadedFiles() : any {
    return this.httpClient.get(this.server_url+'fileList').pipe(
      map((res)=> {
        this.files = res['data'];
        return this.files;
      })
    )
  }
}
