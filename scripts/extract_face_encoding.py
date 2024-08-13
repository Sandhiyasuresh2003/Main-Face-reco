import sys
import face_recognition
import json

image_path = sys.argv[1]
image = face_recognition.load_image_file(image_path)
face_encodings = face_recognition.face_encodings(image)

if face_encodings:
    # Only take the first face encoding if multiple faces are detected
    print(json.dumps(face_encodings[0].tolist()))
else:
    print(json.dumps([]))
