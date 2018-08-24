#import
import time
import serial
import locale
import MySQLdb
import RPi.GPIO as GPIO
from time import sleep
import datetime as fecha
from datetime import datetime
from time import strftime
import Adafruit_CharLCD as LCD
 
GPIO.setmode(GPIO.BCM)

locale.setlocale(locale.LC_TIME,'es_CL.UTF-8')
arduino2 = serial.Serial('/dev/ttyACM0', 9600)
arduino1 = serial.Serial('/dev/ttyUSB0', 9600)
starttime = time.time()

#declaring LCD pins
lcd_rs = 21
lcd_en = 20
lcd_d4 = 16
lcd_d5 = 12
lcd_d6 = 7
lcd_d7 = 8
 
lcd_backlight = 19
 
lcd_columns = 20 #Lcd column
lcd_rows = 24 #number of LCD rows
 
lcd = LCD.Adafruit_CharLCD(lcd_rs, lcd_en, lcd_d4, lcd_d5, lcd_d6, lcd_d7, lcd_columns, lcd_rows, lcd_backlight)

my_pwm=GPIO.PWM(19,100)
my_pwm.start(10)
my_pwm.ChangeFrequency(1000)
my_pwm.ChangeDutyCycle(30)
                           
while True:
    try:
        mifecha = fecha.datetime.now()
        conexion = MySQLdb.connect(host="localhost", user="pi", password="0000", database="meteorino") or die ("Connection error")
        cursor = conexion.cursor()
        datos1 = arduino1.readline()
        pieces1 = datos1.decode().split('\t')
        datos2 = arduino2.readline()
        pieces2 = datos2.decode().split('\t')
        
        
        lcd.set_cursor(0,0)
        lcd.message("H:"+pieces1[0]+"%"+" T:"+pieces1[1]+"C")
        lcd.set_cursor(0,1)
        lcd.message("P:"+pieces1[2]+"mb")
        lcd.set_cursor(0,2)
        lcd.message("V:"+pieces1[4]+"kmh al "+pieces1[3])
        lcd.set_cursor(0,3)
        lcd.message("CO2:"+pieces2[0]+"ppm")

    finally:
        pass

##    if pieces[3] >= "570" and pieces[3] <= "568":
##        pieces[3] = "N"
##    elif pieces[3] >= "807" and pieces[3] <= "815":
##            pieces[3] = "NE"
##    elif pieces[3] >= "976" and pieces[3] <= "989":
##            pieces[3] = "E"
##    elif pieces[3] >= "949" and pieces[3] <= "961":
##            pieces[3] = "SE"
##    elif pieces[3] >= "896" and pieces[3] <= "909":
##            pieces[3] = "S"
##    elif pieces[3] >= "696" and pieces[3] <= "703":
##            pieces[3] = "SO"
##    elif pieces[3] >= "396" and pieces[3] <= "399":
##            pieces[3] = "O"   
##    elif pieces[3] >= "428" and pieces[3] <= "487":
##            pieces[3] = "NO"
##    else:
##            pieces[3] = "No data"
    
    try:
        print("Subiendo datos...")
        with conexion.cursor() as cursor:
            sqlQuery1 = "INSERT INTO weather(fecha,humedad,temperatura,presion,vientodir,vientovel,lluvia,luz,co2,uv,polvo,temperatura2) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
            cursor.execute(sqlQuery1,(mifecha,pieces1[0],pieces1[1],pieces1[2],pieces1[3],pieces1[4],pieces1[5],pieces1[6],pieces2[0],pieces2[1],pieces2[2],pieces2[3]))
            conexion.commit()
    finally:
        conexion.close()
        time.sleep(60.0 - ((time.time() - starttime) % 60.0))
