#include <OneWire.h>
#include <DallasTemperature.h>
////////////////// DS18B20 ////////////////////
#define ONE_WIRE_BUS 4
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
////////////////// MG811 //////////////////////
#define MG_PIN    (A2)    
#define BOOL_PIN  (2)
#define DC_GAIN   (8.5)   
#define READ_SAMPLE_INTERVAL  (50)  
#define READ_SAMPLE_TIMES     (5)   
#define ZERO_POINT_VOLTAGE    (0.220)
#define REACTION_VOLTGAE      (0.030)
float CO2Curve[3]  =  {2.602,ZERO_POINT_VOLTAGE,(REACTION_VOLTGAE/(2.602-3))};   
////////////////// ML8511 ////////////////////
int UVOUT = A0;
int REF_3V3 = A1;
////////////////// DUST SENSOR ///////////////
int measurePin = 0;
int ledPower = 2;
int samplingTime = 280;
int deltaTime = 40;
int sleepTime = 9680;
float voMeasured = 0;
float calcVoltage = 0;
float dustDensity = 0;
float densidad = 0;
//////////////////////////////////////////////

void setup()
{
    Serial.begin(9600);
    sensors.begin();            
    pinMode(BOOL_PIN, INPUT);                   
    digitalWrite(BOOL_PIN, HIGH);
    pinMode(UVOUT, INPUT);
    pinMode(REF_3V3, INPUT);                        
}

void loop()
{
    sensors.requestTemperatures();
    
    delayMicroseconds(samplingTime);
    voMeasured = analogRead(measurePin);
    delayMicroseconds(deltaTime);
    delayMicroseconds(sleepTime);
    calcVoltage = voMeasured * 0.0048828125;
    dustDensity = 0.17 * calcVoltage - 0.1;
    densidad = dustDensity * 1000;
  
    int uvLevel = averageAnalogRead(UVOUT);
    int refLevel = averageAnalogRead(REF_3V3);
    float outputVoltage = 3.3 / refLevel * uvLevel;
    float intensidad = mapfloat(outputVoltage, 0.99, 2.8, 0.0, 15.0); 

    int percentage;
    float volts;
    volts = MGRead(MG_PIN);
    percentage = MGGetPercentage(volts,CO2Curve);
    
    Serial.print(percentage);  
    Serial.print("\t");  
    Serial.print(intensidad);
    Serial.print("\t");
    Serial.print(densidad);
    Serial.print("\t");
    Serial.println(sensors.getTempCByIndex(0));
    
    delay(1000);
}

float MGRead(int mg_pin)
{
    int i;
    float v=0;

    for (i=0;i<READ_SAMPLE_TIMES;i++) {
        v += analogRead(mg_pin);
        delay(READ_SAMPLE_INTERVAL);
    }
    v = (v/READ_SAMPLE_TIMES) *5/1024 ;
    return v;  
}

int  MGGetPercentage(float volts, float *pcurve)
{
   if ((volts/DC_GAIN )>=ZERO_POINT_VOLTAGE) {
      return -1;
   } else { 
      return pow(10, ((volts/DC_GAIN)-pcurve[1])/pcurve[2]+pcurve[0]);
   }
}

int averageAnalogRead(int pinToRead)
{
  byte numberOfReadings = 8;
  unsigned int runningValue = 0; 

  for(int x = 0 ; x < numberOfReadings ; x++)
    runningValue += analogRead(pinToRead);
  runningValue /= numberOfReadings;

  return(runningValue);
}

float mapfloat(float x, float in_min, float in_max, float out_min, float out_max)
{
  return (x - in_min) * (out_max - out_min) / (in_max - in_min) + out_min;
}
