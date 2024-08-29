const clientId = Math.random().toString(16).substr(2, 8);
const host = "wss://sonyya.cloud.shiftr.io:443";

const options = {
  keepalive: 30,
  clientId: clientId,
  username: "sonyya",
  password: "IcwUivav802eC2qY",
  protocolId: "MQTT",
  protocolVersion: 4,
  clean: true,
  reconnectPeriod: 1000,
  connectTimeout: 30 * 1000,
};

console.log("Menghubungkan ke Broker");
const client = mqtt.connect(host, options);

client.on("connect", () => {
  console.log("Terhubung");
  document.getElementById("status").innerHTML = "Terhubung";
  document.getElementById("status").style.color = "blue";

  client.subscribe("monitoring/#", { qos: 1 });
});

client.on("message", function (topic, payload) {
  if (topic === "monitoring/12345678/suhu") {
    document.getElementById("suhu").innerHTML = payload;
  } else if (topic === "monitoring/12345678/kelembaban") {
    document.getElementById("kelembaban").innerHTML = payload;
  } else if (topic === "monitoring/12345678/usonic") {
    document.getElementById("usonic").innerHTML = payload;
  } else if (topic === "monitoring/12345678/servo") {
    let servo1 = $("#servo").data("ionRangeSlider");

    servo1.update({
      from: payload.toString(),
    });
  } else if (topic === "monitoring/12345678/led") {
    if (payload == "nyala") {
      document.getElementById("label-lampu1-nyala").classList.add("active");
      document.getElementById("label-lampu1-mati").classList.remove("active");
    } else {
      document.getElementById("label-lampu1-nyala").classList.remove("active");
      document.getElementById("label-lampu1-mati").classList.add("active");
    }
  }

  if (topic.includes("monitoring/status/")) {
    document.getElementById(topic).innerHTML = payload;

    if (payload.toString() === "offline") {
      document.getElementById(topic).style.color = "red";
    } else if (payload.toString() === "online") {
      document.getElementById(topic).style.color = "blue";
    }
  }
});

function publishServo(value) {
  data = document.getElementById("servo").value;
  client.publish("monitoring/12345678/servo", data, { qos: 1, retain: true });
}

function publishLampu(value) {
  if (document.getElementById("lampu1-nyala").checked) {
    data = "nyala";
  }

  if (document.getElementById("lampu1-mati").checked) {
    data = "mati";
  }

  client.publish("monitoring/12345678/led", data, { qos: 1, retain: true });
}
