import React, { useEffect, useRef, useState } from "react";

import http from "./http";
import Loading from "./Loading";

function App() {
  const inputFileRef = useRef();
  const [photos, setPhotos] = useState([]);

  useEffect(() => {
    handleInit();
  }, []);

  async function handleInit() {
    try {
      const { data } = await http.get("photos");
      setPhotos(data);
    } catch (error) {
      console.log(error);
    }
  }
  async function handleSend() {
    try {
      if (inputFileRef.current.value) {
        const form = new FormData();
        form.append("image", inputFileRef.current.files[0]);
        const config = { headers: { "content-type": "multipart/form-data" } };
        const response = await http.post("photos", form, config);
        if (response.status === 201) {
          setPhotos((state) => [...state, response.data.model]);
        }
      }
    } catch (error) {
      console.log(error);
    } finally {
      inputFileRef.current.value = "";
    }
  }

  return (
    <div className="container">
      <div>
        <div>
          <h1>Save Image</h1>
          <div className="input-group mb-3">
            <input type="file" ref={inputFileRef} className="form-control" />
            <button type="button" className="btn btn-success" onClick={handleSend}>
              Send
            </button>
          </div>
        </div>
        {photos.length === 0 && <Loading />}
        {photos && (
          <div className="row">
            {photos &&
              photos.map((a, i) => (
                <div className="col-3 text-center mt-3" key={i}>
                  <img alt="" src={`http://localhost:8000/images/${a.filename}`} className="rounded-circle img-fluid" style={{ width: 200, height: 200 }} />
                </div>
              ))}
          </div>
        )}
      </div>
    </div>
  );
}

export default App;
