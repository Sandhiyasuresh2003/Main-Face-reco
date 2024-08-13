import face_recognition
import sys
import base64
from io import BytesIO
from PIL import Image

def image_from_base64(base64_str):
    image_data = base64.b64decode(base64_str)
    return Image.open(BytesIO(image_data))

def recognize_face(base64_image1, base64_image2):
    image1 = image_from_base64(base64_image1)
    image2 = image_from_base64(base64_image2)
    
    img1 = face_recognition.load_image_file(image1)
    img2 = face_recognition.load_image_file(image2)
    
    face_encoding1 = face_recognition.face_encodings(img1)[0]
    face_encoding2 = face_recognition.face_encodings(img2)[0]
    
    return face_recognition.compare_faces([face_encoding1], face_encoding2)[0]

if __name__ == "__main__":
    base64_image1 = sys.argv[1]
    base64_image2 = sys.argv[2]
    result = recognize_face(base64_image1, base64_image2)
    print(result)
