#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#define LED D7
#define LightSensor A0
WiFiClient wifiClient;
const int threshold = 200;
void setup() {
pinMode(LED, OUTPUT);
connectWifi();    // LED pin as output.
}
void loop() {
  Serial.println(analogRead(LightSensor));
  processResponse();
  delay(200);
}
void processResponse(){
  HTTPClient http;
  String Link = "http://iot.benax.rw/projects/9750b82a030cb3c2f4863a55144ca0bf/OTI-Light-Switching-Project/status.php";
  http.begin(wifiClient,Link);     //Specify request destination
  int httpCode = http.GET();            //Send the request
  String payload = http.getString();    //Get the response payload
  // Serial.println(httpCode);
  Serial.println("> "+payload);
  if(payload == "ON"){
    digitalWrite(LED,LOW);
  }else{
    digitalWrite(LED,HIGH);
  }    //Print request response payload
  http.end();  //Close connection
}
void connectWifi(){
  Serial.begin(9600);
  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot
  WiFi.begin("Benax-WiFi(2.4G)","Rc@Nyabihu2023");     //Connect to your WiFi router
  Serial.println("");
  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  //If connection successful show IP address in serial monitor
  Serial.print("Connected to ");
  Serial.println("Benax-WiFi(2.4G)");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
}
void lowlight(){
  if (analogRead(LightSensor) > threshold) {
    HTTPClient http;
    http.begin(wifiClient,"http://iot.benax.rw/projects/9750b82a030cb3c2f4863a55144ca0bf/OTI-Light-Switching-Project/save.php");
    http.addHeader("Content-Type", "application/json");
    String json = "{\"status\":\"OFF\"}";
    int ResponseCode = http.POST(json);
    Serial.print("HTTP Response code for OFF: ");
    Serial.println(ResponseCode);
    http.end();
}else {
    HTTPClient http;
    http.begin(wifiClient,"http://iot.benax.rw/projects/9750b82a030cb3c2f4863a55144ca0bf/OTI-Light-Switching-Project/save.php");
    http.addHeader("Content-Type", "application/json");
    String json = "{\"status\":\"ON\"}";
    int ResponseCode = http.POST(json);
    Serial.print("HTTP Response code for ON: ");
    Serial.println(ResponseCode);
    http.end();
  }
}