import { Injectable } from '@angular/core';
import { HttpClient, HttpEvent, HttpResponse, HttpEventType} from '@angular/common/http';
import { map } from 'rxjs/operators';
@Injectable({
  providedIn: 'root'
})
export class UploadService {

  server_url = "http://localhost/ngphp/"
  files;

  constructor(private httpClient: HttpClient) { }

  public uploadFile(data) {
    return this.httpClient.post<any>(this.server_url+'upload', data, {responseType: 'text' as 'json'}).pipe(
      map((res)=> {
        this.files.push(res['data']);
        return this.files;
      })
    );
  }

  public getUploadedFiles() : any {
    return this.httpClient.get(this.server_url+'/fileList').pipe(
      map((res)=> {
        console.log(res);
        console.log("look "+res['data'][0].image);
        this.files = res['data'];
        return this.files;
      })
    )
  }
}
